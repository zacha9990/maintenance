<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceCriteria;
use App\Models\ToolCategory;
use Illuminate\Http\Request;

class MaintenanceCriteriaController extends Controller
{
    public function index($id)
    {
        $toolCategory = ToolCategory::findOrFail($id);

        $maintenanceCriterias = $toolCategory->maintenanceCriteria;

        return view('maintenance_criterias.index', compact('toolCategory', 'maintenanceCriterias'));
    }

    public function create($id)
    {
        $toolCategory = ToolCategory::findOrFail($id);
        return view('maintenance_criterias.create', compact('toolCategory'));

    }


    public function store(Request $request)
    {
        $request->validate(['tool_category.*' => 'required|exists:tool_categories,id',
            'name.*' => 'required|string|max:255',
            'description.*' => 'nullable|string',
        ]);

        $data = $request->except('_token');

        // Access the individual arrays
        $toolCategories = $data['tool_category'];
        $names = $data['name'];
        $descriptions = $data['description'];

        // Perform the store process for each set of data
        foreach ($toolCategories as $index => $toolCategory) {
            $name = $names[$index];
            $description = $descriptions[$index];

            MaintenanceCriteria::create([
                'category_id' => $toolCategory,
                'name' => $name,
                'description' => $description,
            ]);
        }

        return redirect()->route('maintenance-criterias.index', $request->tool_category[0])->with('success', 'Kriteria pemeliharaan dibuat dengan sukses.');
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
        $toolCategoryId = $maintenanceCriteria->category->id;
        $maintenanceCriteria->delete();

        return redirect()->route('maintenance-criterias.index', $toolCategoryId)->with('success', 'Kriteria pemeliharaan berhasil dihapus.');
    }
}
