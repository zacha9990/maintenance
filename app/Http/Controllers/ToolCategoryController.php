<?php

namespace App\Http\Controllers;

use App\Models\ToolCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Tool;

class ToolCategoryController extends Controller
{
    public function index()
    {
        return view('tool_categories.index');
    }

    public function toolCategory(Request $request, ToolCategory $category)
    {
        if ($request->ajax()) {
            $tools = Tool::where('tool_type_id', $category->id)->get();

            return DataTables::of($tools)
                ->addColumn('action', function ($tool) {
                    return '<a href="#" class="btn btn-primary">Detail</a>';
                })
                ->make(true);
        }

        return view('tools.tools_by_category', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
        ]);

        $toolCategory = ToolCategory::create($request->all());

        return response()->json(['success' => true, 'toolCategory' => $toolCategory]);
    }

    public function update(Request $request, ToolCategory $tool_category)
    {
        $request->validate([
            'name' => 'required|max:191',
        ]);

        $tool_category->update($request->all());

        return response()->json(['success' => true, 'toolCategory' => $tool_category]);
    }

    public function destroy(ToolCategory $tool_category)
    {
        $tool_category->delete();

        return response()->json(['success' => true]);
    }

    public function datatable()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $tool_categories = ToolCategory::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'name', 'id'
        ])->orderBy('id', 'ASC');

        return DataTables::of($tool_categories)
            ->editColumn('rownum', function ($tool_category) {
                return substr($tool_category->rownum, 1);
            })
            ->addColumn('action', function ($tool_category) {
                $editButton = '<button class="btn btn-sm btn-primary edit" data-id="' . $tool_category->id . '">Edit</button>';
                $deleteButton = '<button class="btn btn-sm btn-danger delete" data-id="' . $tool_category->id . '">Delete</button>';
            $criteriaButton = '<a class="btn btn-sm btn-secondary" href="' . route("maintenance-criterias.index", $tool_category->id) . '">Kriteria Pemeliharaan</a>';

            $toolsCount = $tool_category->tools()->count();
            $toolsButton = '<a class="btn btn-sm btn-info" href="' . route('tool_categories.tools.index', $tool_category->id) . '">Daftar Alat <span class="badge bg-dark">' . $toolsCount . '</span></a>';

            return $editButton . ' ' .
                $criteriaButton .
                ' ' . $toolsButton .
                ' ' . $deleteButton;
            })
            ->rawColumns(['action', 'rownum'])
            ->make(true);
    }
}
