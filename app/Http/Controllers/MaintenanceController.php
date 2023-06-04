<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Staff;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    public function show($toolId)
    {
        $tool = Tool::findOrFail($toolId);
        $maintenances = $tool->maintenances;

        return view('maintenances.show', compact('tool', 'maintenances'));
    }

    public function create(Tool $tool)
    {
        $technicians = Staff::with('user')->get();

        return view('maintenances.create', compact('tool', 'technicians'));
    }

    public function store(Request $request, Tool $tool)
    {
        $validator = Validator::make($request->all(), [
            'scheduled_date' => 'required|date|after_or_equal:today',
            'type' => 'required',
            'responsible_technician' => 'required|exists:staffs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $maintenance = new Maintenance();
        $maintenance->tool_id = $tool->id;
        $maintenance->scheduled_date = $request->input('scheduled_date');
        $maintenance->assign_date = $request->input('scheduled_date');
        $maintenance->type = $request->input('type');
        $maintenance->responsible_technician = $request->input('responsible_technician');
        // Set other fields as needed

        $maintenance->save();

        return redirect()->route('maintenances.show', $tool->id)->with('success', 'Data maintenance created successfully');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $technicians = Staff::with('user')->get();

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
        // Update other fields accordingly

        $maintenance->save();

        return response()->json(['message' => 'Maintenance updated successfully']);
    }
}
