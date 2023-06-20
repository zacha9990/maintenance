<?php

namespace App\Http\Controllers;

use App\Models\{
    Factory,
    Tool
};
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

                $toolsCount = $factory->tools()->count();
                $toolsButton = '<a href="' . route('factories.tools', $factory->id) . '" class="btn btn-info btn-sm">Daftar Alat <span class="badge bg-dark">' . $toolsCount . '</span></a>';

                return $editButton . '&nbsp;' . $toolsButton . '&nbsp;' . '<button type="button" class="btn btn-danger btn-sm btn-delete" data-url="' . $deleteUrl . '">Delete</button>';
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

    public function tools(Request $request, $id)
    {
        $factory = Factory::findOrFail($id);

        return view('factories.tools', compact('factory'));
    }

    public function toolList(Request $request, $id)
    {
        $tools = Tool::with('spareparts', 'maintenancePeriod');

        $tools = $tools->where('factory_id', $id)->get();

        return DataTables::of($tools)
            ->addColumn('information_buttons', function ($tool) {
                return
                    '<button class="btn btn-primary btn-sm btn-spareparts" data-bs-toggle="modal"
                data-bs-target="#spareparts-modal" data-tool-id="' . $tool->id . '"><i class="fas fa-tools"></i></button>' . " " .
                    '<button class="btn btn-primary btn-sm btn-maintenance" data-bs-toggle="modal"
                data-bs-target="#maintenance-modal" data-tool-id="' . $tool->id . '"><i class="fas fa-calendar"></i></button>' . " " .
                    '<a class="btn btn-primary btn-sm btn-edit" href="' . route('tools.edit', $tool->id) . '"><i class="fas fa-edit  "></i></a>' . " " .
                    '<a class="btn btn-danger btn-sm btn-maintenance-schedule" href="' . route('maintenances.show', $tool->id) . '"><i class="fas fa-calendar  "></i></a>';
            })
            ->rawColumns(['information_buttons'])
            ->make(true);
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
