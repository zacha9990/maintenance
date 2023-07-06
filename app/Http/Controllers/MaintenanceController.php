<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Staff;
use App\Models\Maintenance;
use App\Models\MaintenanceCriteria;
use App\Models\RepairRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenances.index');
    }

    public function myMaintenances()
    {
        return view('maintenances.my');
    }
    public function getData(Request $request)
    {
        $query = Maintenance::query()->with('tool')->orderBy('created_at', 'desc');

        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $query = $query->whereHas('tool.factory', function ($query) use ($user2) {
                $query->where('id', $user2->staff->factory_id);
            });
        }

        if (Auth::user()->hasRole(['Teknisi'])) {
            $query->where('responsible_technician', Auth::user()->staff->id);
        }

        if ($request->has('statusFilter')) {
            $statusFilter = $request->input('statusFilter');
            if ($statusFilter) {
                $query->where('status', $statusFilter);
            }
        }

         $query =  $query->get();

        return DataTables::of($query)
            ->addColumn('tool_name', function ($maintenance) {
                return $maintenance->tool->name;
            })
            ->addColumn('scheduled_date', function ($maintenance) {
                return $maintenance->scheduled_date;
            })
            ->addColumn('status', function ($maintenance) {
                $status = '';
                $badgeClass = '';

                switch ($maintenance->status) {
                    case 'not_assigned':
                        $status = 'Belum Ditugaskan';
                        $badgeClass = 'bg-secondary';
                        break;
                    case 'assigned':
                        $status = 'Ditugaskan';
                        $badgeClass = 'bg-info';
                        break;
                    case 'on_progress':
                        $status = 'Dikerjakan';
                        $badgeClass = 'bg-primary';
                        break;
                    case 'completed':
                        $status = 'Selesai';
                        $badgeClass = 'bg-success';
                        break;
                    case 'cancelled':
                        $status = 'Dibatalkan';
                        $badgeClass = 'bg-danger';
                        break;
                }

                return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
            })
            ->addColumn('assign_date', function ($maintenance) {
            return Carbon::parse($maintenance->assign_date)->translatedFormat('j F Y');
            })
            ->addColumn('start_date', function ($maintenance) {
            return Carbon::parse($maintenance->start_date)->translatedFormat('j F Y');
            })
            ->addColumn('completed_date', function ($maintenance) {
            return Carbon::parse($maintenance->completed_date)->translatedFormat('j F Y');
            })
            ->addColumn('action', function ($maintenance) {
                $startButton = '';
                $completeButton = '';
            $reportButton = '';

                if ($maintenance->status === 'assigned') {
                    $startButton = '<button type="button" class="btn btn-primary btn-sm start-button" data-id="' . $maintenance->id . '" title="Mulai Kerjakan"><i class="fas fa-play"></i></button>';
                } elseif ($maintenance->status === 'on_progress') {
                    $completeButton = '<button type="button" class="btn btn-success btn-sm complete-button" data-maintenance-id="' . $maintenance->id . '" title="Selesaikan Tugas" data-bs-toggle="modal" data-bs-target="#completeModal"><i class="fas fa-check"></i></button>';
                }

            if ($maintenance->status == 'completed') {
                $reportButton = '<a class="btn btn-default btn-outline-warning btn-sm report-button" href="' . route('reports.laporanRealisasiMaintenance', $maintenance->id) . '" title="Laporan Realisasi""><i class="fas fa-file"></i></a>';
            }

            return $startButton . ' ' . $completeButton . ' ' . $reportButton;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function startMaintenance(Request $request)
    {
        $maintenanceId = $request->input('id');
        $maintenance = Maintenance::findOrFail($maintenanceId);

        // Cek apakah pengguna memiliki akses untuk memulai maintenance
        if (Auth::user()->hasRole('Teknisi') && $maintenance->status === 'assigned') {
            $maintenance->status = 'on_progress';
            $maintenance->start_date = date('Y-m-d');
            $maintenance->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal memulai maintenance.']);
    }

    public function completeMaintenance(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Cek apakah pengguna memiliki akses untuk menyelesaikan maintenance
        if (Auth::user()->hasRole(['Teknisi', 'SuperAdmin', 'Operator']) && $maintenance->status === 'on_progress') {
            $maintenance->result = $request->input('result');
            $maintenance->details = $request->input('details');
            $maintenance->status = 'completed';
            $maintenance->completed_date = date('Y-m-d');

            if ($maintenance->type === 'Internal') {
                $maintenance->action_taken_internal = $request->input('action_taken');
            } else {
                $maintenance->action_taken_external = $request->input('action_taken');
            }

            $details['details'] = $maintenance->details;
            $details['criterias'] = $request->input('maintenance_criteria_values');

            $maintenance->details = json_encode($details);

            $maintenance->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyelesaikan maintenance.']);
    }

    public function cancelMaintenance($id)
    {
        try {
            $maintenance = Maintenance::findOrFail($id);

            // Hanya izinkan pembatalan jika status belum dibatalkan
            if ($maintenance->status != 'cancelled') {
                $maintenance->status = 'cancelled';
                $maintenance->save();
            }

            return response()->json(['message' => 'Maintenance berhasil dibatalkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat membatalkan maintenance'], 500);
        }
    }


    public function show($toolId)
    {
        $tool = Tool::findOrFail($toolId);
        $maintenances = $tool->maintenances;

        return view('maintenances.show', compact('tool', 'maintenances'));
    }

    public function showDetails($id)
    {
        $maintenance = Maintenance::findOrFail($id)::findOrFail($id);

        $status = [
            'not_assigned' => [
                'label' => 'Belum Ditugaskan',
                'badgeClass' => 'bg-secondary',
            ],
            'assigned' => [
                'label' => 'Ditugaskan',
                'badgeClass' => 'bg-info',
            ],
            'on_progress' => [
                'label' => 'Dikerjakan',
                'badgeClass' => 'bg-primary',
            ],
            'completed' => [
                'label' => 'Selesai',
                'badgeClass' => 'bg-success',
            ],
            'cancelled' => [
                'label' => 'Dibatalkan',
                'badgeClass' => 'bg-danger',
            ],
        ];

        $automatedStatus = [
            'automated' => [
                'label' => 'Belum Ditugaskan',
                'badgeClass' => 'bg-secondary',
            ],
            'damage_report' => [
                'label' => 'Laporan Kerusakan',
                'badgeClass' => 'bg-danger',
            ],
            'scheduled' => [
                'label' => 'Dikerjakan',
                'badgeClass' => 'bg-primary',
            ],
        ];

        $maintenance->status = $status[$maintenance->status];
        if ($maintenance->details) {
            $maintenanceDetails = array();
            $maintenanceResultCriteria = array();
            $details =  json_decode($maintenance->details, true);
            if (isset($details['criterias'])){
                $criterias = $details['criterias'];
                foreach ($criterias as $key => $criteria) {
                    $maintenanceCriteria = MaintenanceCriteria::find($key);
                    if ($maintenanceCriteria) {
                        $temp['id'] = $maintenanceCriteria->id;
                        $temp['name'] = $maintenanceCriteria->name;
                        $temp['result'] = $criteria;
                        array_push($maintenanceResultCriteria, $temp);
                    }
                }
                $maintenanceDetails['details'] = $details['details'];
                $maintenanceDetails['criterias'] = $maintenanceResultCriteria;
                $maintenance->details = $maintenanceDetails;
            }
        }
        $maintenance->automated_status = $automatedStatus[$maintenance->automated_status];

        return view('maintenances.show_details', compact('maintenance'));
    }

    public function create(Tool $tool)
    {
        $technicians = Staff::with('user', 'position')
        ->whereHas('position.role', function ($query) {
            $query->where('name', 'Teknisi');
        })->get();

        $repairs = RepairRequest::where('approved', '1')->get();

        return view('maintenances.create', compact('tool', 'technicians', 'repairs'));
    }

    public function store(Request $request, Tool $tool)
    {
        $validator = Validator::make($request->all(), [
            'scheduled_date' => 'required|date|after_or_equal:today',
            'type' => 'required',
            'responsible_technician' => 'required|exists:staffs,id',
             'repair_id' => 'required_if:automated_status,damage_report',
        ], [
            'repair_id.required_if' => 'The repair report field is required when automated status is set to damage_report.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $maintenance = new Maintenance();
        $maintenance->tool_id = $tool->id;
        $maintenance->scheduled_date = $request->input('scheduled_date');
        $maintenance->assign_date = $request->input('scheduled_date');
        $maintenance->status = "assigned";
        $maintenance->type = $request->input('type');
        $maintenance->automated_status = $request->input('automated_status');
        $maintenance->description = $request->input('description');
        $maintenance->responsible_technician = $request->input('responsible_technician');

        if ($request->input('repair_id') > 0) {
            $maintenance->repair_id = $request->input('repair_id');
            $maintenance->automated_status = "damage_report";
            $repairRequest = RepairRequest::findOrFail($maintenance->repair_id);
            $maintenance->type = $repairRequest->maintenance_type;
        }

        $maintenance->save();

        return redirect()->route('maintenances.show', $tool->id)->with('success', 'Data maintenance created successfully');
    }


    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $technicians = Staff::with('user', 'position')
        ->whereHas('position.role', function ($query) {
            $query->where('name', 'Teknisi');
        })->get();

        return view('maintenances.edit', compact('maintenance', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $request->validate([
            'type' => 'required',
            'responsible_technician' => 'required',
            // Add validation rules for other input fields
        ]);

        $maintenance->type = $request->input('type');
        $maintenance->responsible_technician = $request->input('responsible_technician');
        $maintenance->assign_date = now()->toDateString();
        $maintenance->automated_status = $request->input('automated_status');
        $maintenance->description = $request->input('description');
        $maintenance->status = 'assigned';
        // Update other fields accordingly

        $maintenance->save();

        return response()->json(['message' => 'Maintenance updated successfully']);
    }
}
