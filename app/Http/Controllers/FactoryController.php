<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;
use DataTables;

class FactoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $factories = Factory::latest()->get();
            return DataTables::of($factories)
                ->addColumn('action', function ($factory) {
                    $editButton = '<button type="button" class="btn btn-primary btn-sm btn-edit" data-id="' . $factory->id . '">Edit</button>';
                    $deleteUrl = route('factories.destroy', $factory->id);
                    return $editButton  . '&nbsp;' .
                        '<button type="button" class="btn btn-danger btn-sm btn-delete" data-url="' . $deleteUrl . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('factories.index');
    }

    public function store(Request $request)
    {
        Factory::create($request->all());

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $factory = Factory::findOrFail($id);

        return response()->json(['factory' => $factory]);
    }

    public function update(Request $request, $id)
    {
        $factory = Factory::findOrFail($id);
        $factory->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Factory::destroy($id);

        return response()->json(['success' => true]);
    }
}
