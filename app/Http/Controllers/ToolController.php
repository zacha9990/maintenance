<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\{
    ToolCategory,
    Factory,
    Sparepart,
    Inventory,
    MaintenancePeriod,
    Tool,
    User
};
use Carbon\Carbon;
use Auth;

class ToolController extends Controller
{

    public function index()
    {
        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();
        return view('tools.index', compact('factories'));
    }

    public function list(Request $request)
    {
        $factoryId = $request->input('factory_id');
        $tools = Tool::with('spareparts', 'maintenancePeriod');


        if ($factoryId) {
            $tools->where('factory_id', $factoryId);
        }

        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $tools->where('factory_id', $user2->staff->factory_id);
        }

        $tools = $tools->get();

        return DataTables::of($tools)
            ->editColumn('purchase_date', function ($tool) {
                return Carbon::parse($tool->purchase_date)->translatedFormat('j F Y');
            })
            ->addColumn('information_buttons', function ($tool) {
            return
                '<button class="btn btn-primary btn-sm btn-spareparts" data-bs-toggle="modal"
                data-bs-target="#spareparts-modal" data-tool-id="' . $tool->id . '"><i class="fas fa-tools"></i></button>' . " " .
            '<button class="btn btn-primary btn-sm btn-maintenance" data-bs-toggle="modal"
                data-bs-target="#maintenance-modal" data-tool-id="' . $tool->id . '"><i class="fas fa-calendar"></i></button>' . " " .
            '<a class="btn btn-primary btn-sm btn-edit" href="' . route('tools.edit', $tool->id) . '"><i class="fas fa-edit"></i></a>' . " " .
            '<a class="btn btn-success btn-sm btn-view" href="' . route('tools.show', $tool->id) . '"><i class="fas fa-eye"></i></a>' . " " .
            '<a class="btn btn-danger btn-sm btn-maintenance-schedule" href="' . route('maintenances.show', $tool->id) . '"><i class="fas fa-calendar  "></i></a>' . " " .
            '<a class="btn btn-outline-danger btn-sm btn-maintenance-history" data-toggle="tooltip" title="Riwayat Maintenance" href="' . route('reports.laporanRiwayatMaintenance', $tool->id) . '"><i class="fas fa-history  "></i></a>';
            })
            ->rawColumns(['information_buttons'])
        ->make(true);
    }

    public function show(Tool $tool)
    {
        return view('tools.show', compact('tool'));
    }

    public function getToolSpareparts(Request $request, Tool $tool)
    {
        $spareparts = $tool->spareparts()->select('sparepart_name', 'sparepart_quantity')->get();

        return response()->json([
            'data' => $spareparts
        ]);
    }

    public function getToolMaintenancePeriod(Request $request, Tool $tool)
    {
        $maintenancePeriods = $tool->maintenancePeriod()->select('maintenance_period', 'maintenance_type')->get();

        return response()->json([
            'data' => $maintenancePeriods
        ]);
    }

    public function create()
    {
        $toolTypes = ToolCategory::all();
        $factories = Factory::query();
        $spareparts = Sparepart::with('factories');


        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);

            $factories = $factories->where('id', $user2->staff->factory_id);
            $factory = Factory::find($user2->staff->factory_id);
            $spareparts = $factory->spareparts;
        } else {
            $spareparts = $spareparts->get();
        }

        $factories = $factories->get();

        return view('tools.create', compact('toolTypes', 'factories', 'spareparts'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'name' => 'required|string',
            'serial_number' => 'nullable|string|unique:tools',
            'function' => 'required|string',
            'brand' => 'required|string',
            'serial_type' => 'nullable|string',
            'purchase_date' => 'required|date',
            'technical_specification' => 'required|string',
            'tool_type_id' => 'required|exists:tool_categories,id',
            'factory_id' => 'required|exists:factories,id',
            'spareparts' => 'nullable|array',
            'spareparts.*' => 'exists:spareparts,id',
            'tool_quantity' => 'required|integer',
            'tool_location' => 'required|string',
            'tool_status' => 'required|string',
            'maintenance_period' => 'required|integer',
            'maintenance_type' => 'required|string|in:daily,weekly,monthly,yearly',
        ]);

        // Simpan data peralatan (tools)
        $tool = new Tool();
        $tool->name = $validatedData['name'];
        $tool->serial_number = $validatedData['serial_number'];
        $tool->function = $validatedData['function'];
        $tool->brand = $validatedData['brand'];
        $tool->serial_type = $validatedData['serial_type'];
        $tool->purchase_date = $validatedData['purchase_date'];
        $tool->technical_specification = $validatedData['technical_specification'];
        $tool->tool_type_id = $validatedData['tool_type_id'];
        $tool->factory_id = $validatedData['factory_id'];
        $tool->save();

        // Simpan data inventaris (inventories)
        $inventory = new Inventory();
        $inventory->tool_id = $tool->id;
        $inventory->tool_quantity = $validatedData['tool_quantity'];
        $inventory->tool_location = $validatedData['tool_location'];
        $inventory->tool_status = $validatedData['tool_status'];
        $inventory->save();

        // Simpan data periode perawatan (maintenance_periods)
        $maintenancePeriod = new MaintenancePeriod();
        $maintenancePeriod->tool_id = $tool->id;
        $maintenancePeriod->maintenance_period = $validatedData['maintenance_period'];
        $maintenancePeriod->maintenance_type = $validatedData['maintenance_type'];
        $maintenancePeriod->save();

        // Simpan data relasi antara peralatan dan sparepart (tool_spareparts)
        if (!empty($validatedData['spareparts'])) {
            $tool->spareparts()->attach($validatedData['spareparts']);
        }

        return redirect()->route('tools.index')->with('success', 'Data peralatan berhasil disimpan.');
    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        $toolTypes = ToolCategory::all();
        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();
        $spareparts = Sparepart::all();

        return view('tools.edit', compact('tool', 'toolTypes', 'factories', 'spareparts'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'name' => 'required|string',
            'serial_number' => 'nullable|string|unique:tools,serial_number,' . $id,
            'function' => 'required|string',
            'brand' => 'required|string',
            'serial_type' => 'nullable|string',
            'purchase_date' => 'required|date',
            'technical_specification' => 'required|string',
            'tool_type_id' => 'required|exists:tool_categories,id',
            'factory_id' => 'required|exists:factories,id',
            'spareparts' => 'nullable|array',
            'spareparts.*' => 'exists:spareparts,id',
            'tool_quantity' => 'required|integer',
            'tool_location' => 'required|string',
            'tool_status' => 'required|string',
            'maintenance_period' => 'required|integer',
            'maintenance_type' => 'required|string|in:daily,weekly,monthly,yearly',
        ]);

        $tool = Tool::findOrFail($id);

        // Update data peralatan (tools)
        $tool->name = $validatedData['name'];
        $tool->serial_number = $validatedData['serial_number'];
        $tool->function = $validatedData['function'];
        $tool->brand = $validatedData['brand'];
        $tool->serial_type = $validatedData['serial_type'];
        $tool->purchase_date = $validatedData['purchase_date'];
        $tool->technical_specification = $validatedData['technical_specification'];
        $tool->tool_type_id = $validatedData['tool_type_id'];
        $tool->factory_id = $validatedData['factory_id'];
        $tool->save();

        // Update data inventaris (inventories)
        $inventory = $tool->inventory;
        if (!$inventory) {
            $inventory = new Inventory();
            $inventory->tool_id = $tool->id;
        }
        $inventory->tool_quantity = $validatedData['tool_quantity'];
        $inventory->tool_location = $validatedData['tool_location'];
        $inventory->tool_status = $validatedData['tool_status'];
        $inventory->save();

        // Update data periode perawatan (maintenance_periods)
        $maintenancePeriod = $tool->maintenancePeriod;
        if (!$maintenancePeriod) {
            $maintenancePeriod = new MaintenancePeriod();
            $maintenancePeriod->tool_id = $tool->id;
        }
        $maintenancePeriod->maintenance_period = $validatedData['maintenance_period'];
        $maintenancePeriod->maintenance_type = $validatedData['maintenance_type'];
        $maintenancePeriod->save();

        // Update data relasi antara peralatan dan sparepart (tool_spareparts)
        if (!empty($validatedData['spareparts'])) {
            $tool->spareparts()->sync($validatedData['spareparts']);
        } else {
            $tool->spareparts()->detach();
        }

        return redirect()->route('tools.index')->with('success', 'Data peralatan berhasil diperbarui.');
    }
}
