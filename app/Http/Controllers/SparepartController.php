<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spareparts.index');
    }

    public function list()
    {
        $spareparts = Sparepart::select(['id', 'sparepart_name', 'sparepart_quantity', 'sparepart_availability'])->get();

        return datatables()->of($spareparts)
            ->addColumn('action', function ($sparepart) {
                $editUrl = route('spareparts.edit', $sparepart->id);
                $viewUrl = route('spareparts.show', $sparepart->id);
                $deleteUrl = route('spareparts.destroy', $sparepart->id);

                return "<a href=\"$editUrl\" class=\"btn btn-sm btn-primary\">Edit</a>
                        <a href=\"$viewUrl\" class=\"btn btn-sm btn-success\">View</a>
                        <button type=\"button\" class=\"btn btn-sm btn-danger delete-sparepart\" data-url=\"$deleteUrl\">Delete</button>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spareparts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sparepart::create($request->all());

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        return view('spareparts.show', compact('sparepart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sparepart $sparepart)
    {
        return view('spareparts.edit', compact('sparepart'));
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
        $sparepart->update($request->all());

        return response()->json(['success' => true]);
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
