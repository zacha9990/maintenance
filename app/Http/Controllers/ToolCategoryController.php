<?php

namespace App\Http\Controllers;

use App\Models\ToolCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ToolCategoryController extends Controller
{
    public function index()
    {
        return view('tool_categories.index');
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
        $tool_categories = ToolCategory::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'name'
                ])->orderBy('id', 'ASC');


        return DataTables::of($tool_categories)
            ->editColumn('rownum', function ($tool_category) {
                return substr($tool_category->rownum, 1);
            })
            ->addColumn('action', function ($tool_category) {
                $editButton = '<button class="btn btn-sm btn-primary edit" data-id="' . $tool_category->id . '">Edit</button>';
                $deleteButton = '<button class="btn btn-sm btn-danger delete" data-id="' . $tool_category->id . '">Delete</button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action', 'rownum'])
            ->make(true);
    }
}
