<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return view('positions.index', compact('roles'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Position::with('role')->get();
            return DataTables::of($data)
                ->addColumn('role_name', function ($position) {
                    return $position->role ? $position->role->name : '';
                })
                ->addColumn('action', function ($position) {
                    $editUrl = route('positions.edit', $position->id);
                    return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return view('positions.edit', compact('position', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position->role_id = $request->role_id;
        $position->save();

        return redirect()->route('positions.index')->with('success', 'Posisi diperbarui dengan sukses. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}
