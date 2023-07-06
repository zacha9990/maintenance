<?php


namespace App\Http\Controllers;

use App\Models\{
    RepairRequest,
    Staff,
    Tool,
    User
};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;


class RepairRequestController extends Controller
{
    public function index()
    {
        return view('repair_requests.index');
    }

    public function getData(Request $request)
    {
        $approvedStatus = $request->input('approved_status');

        $repairRequests = RepairRequest::with(['staff', 'tool'])
            ->when($approvedStatus != '', function ($query) use ($approvedStatus) {

                if ($approvedStatus == "1") {
                    // dump(1);
                    return $query->where('approved', 1);
                } elseif ($approvedStatus == "99") {
                    // dump(99);
                    return $query->where('approved', 99);
                } else {
                    // dump(0);
                    return $query->where('approved', 0);
                }
                // dd(1);
            });

        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $repairRequests = $repairRequests->whereHas('tool.factory', function ($query) use ($user2) {
                $query->where('id', $user2->staff->factory_id);
            });
        }


        $repairRequests = $repairRequests->get();
        return DataTables::of($repairRequests)
            ->editColumn('description', function ($row) {
                // Modify the 'name' column value here
                return Str::limit($row->description, 50, '...');
            })
            ->addColumn('staff_name', function ($repairRequest) {
                return $repairRequest->staff->user->name;
            })
            ->addColumn('tool_name', function ($repairRequest) {
                return $repairRequest->tool->name;
            })
            ->addColumn('approved_status', function ($repairRequest) {
                $status = '';
                $badgeClass = '';

                switch ($repairRequest->approved) {
                    case 0:
                        $status = 'Belum disetujui';
                        $badgeClass = 'bg-secondary';
                        break;
                    case 1:
                        $status = 'Disetujui';
                        $badgeClass = 'bg-success';
                        break;
                    case 99:
                        $status = 'Ditolak';
                        $badgeClass = 'bg-danger';
                        break;
                }

                return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
            })
            ->addColumn('action', function ($repairRequest) {
                $viewButton = '<a href="' . route('repair_requests.show', $repairRequest->id) . '" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';

                $approveButton = '';
                $rejectButton = '';

            if (Auth::user()->hasRole(['Operator', 'SuperAdmin'])) {

                if ($repairRequest->approved == 0) {
                    $approveButton = '<button class="btn btn-success btn-sm approve-btn" data-id="' . $repairRequest->id . '"><i class="far fa-thumbs-up"></i></button>';
                    $rejectButton = '<button class="btn btn-danger btn-sm reject-btn" data-id="' . $repairRequest->id . '"><i class="far fa-thumbs-down"></i></button>';
                } elseif ($repairRequest->approved == 1) {
                    $rejectButton = '<span class="text-muted">Disetujui</span>';
                } elseif ($repairRequest->approved == 99) {
                    $approveButton = '<span class="text-muted">Ditolak</span>';
                }
            }


                return
                    $viewButton .
                    ' ' . $approveButton . ' ' . $rejectButton;
            })
            ->rawColumns(['action', 'approved_status'])
            ->make(true);
    }

    public function create()
    {

        $tools = Tool::query();

        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);

            $tools = $tools->where('factory_id', $user2->staff->factory_id);
        }

        $tools = $tools->get();

        $superAdmin = false;
        if (Auth::user()->hasRole('SuperAdmin')) {
            $staffs = Staff::with('user', 'position')
                ->whereHas('position.role', function ($query) {
                    $query->where('name', 'Teknisi');
                    $query->orWhere('name', 'Operator');
                })->get();
            $superAdmin = Auth::user()->staff->id;
        } else {
            $staffs = Staff::with('user', 'position')
            ->whereId(Auth::user()->staff->id)
                ->whereHas('position.role', function ($query) {
                    $query->where('name', 'Teknisi');
                    $query->orWhere('name', 'Operator');
                })->get();
        }

        return view('repair_requests.create', compact('staffs', 'tools', 'superAdmin'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'tool_id' => 'required',
            'description' => 'required',
            'maintenance_type' => 'required',
        ]);

        $validatedData['status'] = 'reported';

        // Simpan data repair request ke database
        RepairRequest::create($validatedData);

        if (Auth::user()->hasRole('SuperAdmin')) {
            return redirect()->route('repair_requests.index')->with('success', 'Permintaan perbaikan dibuat dengan sukses');
        } else {
            return redirect()->route('repair_requests.create')->with('success', 'Permintaan perbaikan dibuat dengan sukses');
        }

    }

    public function show($id)
    {
        $repairRequest = RepairRequest::findOrFail($id);

        $status = [
            'reported' => [
                'label' => 'Dilaporkan',
                'badgeClass' => 'bg-info',
            ],
            'working' => [
                'label' => 'Dikerjakan',
                'badgeClass' => 'bg-primary',
            ],
            'finished' => [
                'label' => 'Selesai',
                'badgeClass' => 'bg-success',
            ],
            'cancelled' => [
                'label' => 'Dibatalkan',
                'badgeClass' => 'bg-danger',
            ],
        ];

        $approved = [
            0 => [
                'status' => 'Belum disetujui',
                'badgeClass' => 'bg-secondary',
            ],
            1 => [
                'status' => 'Disetujui',
                'badgeClass' => 'bg-success',
            ],
            99 => [
                'status' => 'Ditolak',
                'badgeClass' => 'bg-danger',
            ],
        ];

        if ($repairRequest->approved_at) {
            $repairRequest->approved_at = $repairRequest->approved_at ? Carbon::parse($repairRequest->approved_at)->format('j F Y H:i:s') : null;
        }

        $repairRequest->status = $status[$repairRequest->status];
        $repairRequest->approved = $approved[$repairRequest->approved];

        return view('repair_requests.show', compact('repairRequest'));
    }

    public function edit($id)
    {
        $repairRequest = RepairRequest::findOrFail($id);

        return view('repair_requests.edit', compact('repairRequest'));
    }

    public function approve(Request $request)
    {
        $repairRequest = RepairRequest::findOrFail($request->id);
        $repairRequest->approved = 1;
        $repairRequest->save();

        return response()->json(['message' => 'Repair request has been approved.']);
    }

    public function reject(Request $request,)
    {
        $repairRequest = RepairRequest::findOrFail($request->id);
        $repairRequest->approved = 99;
        $repairRequest->save();

        return response()->json(['message' => 'Repair request has been rejected.']);
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'tool_id' => 'required',
            'description' => 'required',
        ]);

        // Cari repair request berdasarkan ID
        $repairRequest = RepairRequest::findOrFail($id);

        // Update data repair request
        $repairRequest->update($validatedData);

        return redirect()->route('repair_requests.index')->with('success', 'Permintaan perbaikan diperbarui dengan sukses');
    }

    public function destroy($id)
    {
        $repairRequest = RepairRequest::findOrFail($id);
        $repairRequest->delete();

        return response()->json(['message' => 'Permintaan Perbaikan Dihapus dengan sukses']);
    }
}
