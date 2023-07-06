<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\Factory;
use Yajra\DataTables\Facades\DataTables;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factories = Factory::pluck('name', 'id')->prepend('All', '');
        return view('spareparts.index', compact('factories'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $spareParts = Sparepart::query();
            $factoryId = $request->input('factory_id');

            if ($factoryId) {
                $spareParts->whereHas('factories', function ($query) use ($request) {
                    $query->where('factory_id', $request->factory_id);
                });
            }

            return DataTables::eloquent($spareParts)
                ->addColumn('factory_name', function (SparePart $sparePart) {
                    return $sparePart->factories->pluck('name')->implode('<br>');
                })
                ->addColumn('quantity', function (SparePart $sparePart) use ($factoryId) {
                    $quantity = $factoryId ? $sparePart->factories->find($factoryId)->pivot->quantity : $sparePart->factories->sum('pivot.quantity');
                    return $quantity;
                })
                ->addColumn('action', function ($sparepart) {
                    $editUrl = route('spareparts.edit', $sparepart->id);
                    $viewUrl = route('spareparts.show', $sparepart->id);

                return "<a href=\"$editUrl\" class=\"btn btn-sm btn-primary\">Edit</a>
                            <a href=\"$viewUrl\" class=\"btn btn-sm btn-success\">View</a>";
            })
                ->rawColumns(['factory_name', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factories = Factory::pluck('name', 'id');
        return view('spareparts.create', compact('factories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'factory_id' => 'required|exists:factories,id',
            'sparepart_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $factory = Factory::findOrFail($request->factory_id);

        $sparePart = Sparepart::firstOrCreate(
            ['sparepart_name' => $request->sparepart_name],
            ['timestamps' => false]
        );

        $factory->spareparts()->attach($sparePart->id, ['quantity' => $request->quantity]);

        return redirect()->route('spareparts.index')->with('success', 'SparePart berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        $factories = Factory::all();
        // dd($sparepart);
        return view('spareparts.show', compact('sparepart', 'factories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sparepart $sparepart)
    {
        $factories = Factory::all();
        return view('spareparts.edit', compact('sparepart', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $factories = Factory::all();
        foreach ($factories as $factory) {
            $quantity = $request->input('quantity.' . $factory->id);

            if ($sparepart->factories->contains($factory->id)) {
                $sparepart->factories()->updateExistingPivot($factory->id, ['quantity' => $quantity]);
            } else {
                $sparepart->factories()->attach($factory->id, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('spareparts.index', $sparepart->id)
        ->with('success', 'Kuantitas sparepart berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();

        return response()->json(['success' => true]);
    }
}
