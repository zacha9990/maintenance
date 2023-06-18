<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceCriteria;
use App\Models\ToolCategory;
use Illuminate\Http\Request;

class MaintenanceCriteriaController extends Controller
{
    public function create($id)
    {
        $toolCategory = ToolCategory::findOrFail($id);
        return view('maintenance_criterias.create', compact('toolCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:tool_categories,id',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        MaintenanceCriteria::create($request->all());

        return redirect()->route('maintenance-criterias.index')->with('success', 'Kriteria pemeliharaan dibuat dengan sukses.');
    }

    public function edit(MaintenanceCriteria $maintenanceCriteria)
    {
        $toolCategories = ToolCategory::all();
        return view('maintenance-criterias.edit', compact('maintenanceCriteria', 'toolCategories'));
    }

    public function update(Request $request, MaintenanceCriteria $maintenanceCriteria)
    {
        $request->validate([
            'category_id' => 'required|exists:tool_categories,id',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $maintenanceCriteria->update($request->all());

        return redirect()->route('maintenance-criterias.index')->with('success', 'Kriteria pemeliharaan berhasil diperbarui.');
    }

    public function destroy(MaintenanceCriteria $maintenanceCriteria)
    {
        $maintenanceCriteria->delete();

        return redirect()->route('maintenance-criterias.index')->with('success', 'Kriteria pemeliharaan berhasil dihapus.');
    }
}
