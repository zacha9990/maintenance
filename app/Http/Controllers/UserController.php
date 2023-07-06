<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Factory;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('users.index', compact('positions'));
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['users.id', 'users.name', 'users.email', 'users.contact', 'positions.name as position_name', 'factories.name as fact_name'])
                ->join('staffs', 'users.id', '=', 'staffs.user_id')
            ->join('positions', 'staffs.position_id', '=', 'positions.id')
            ->leftJoin('factories', 'staffs.factory_id', '=', 'factories.id');

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm mx-1">Edit</a>' .
                        '<a href="' . route('users.show', $user->id) . '" class="btn btn-primary btn-sm mx-1">View</a>';;
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('position') && $request->position != '') {
                        $query->where('positions.name', $request->position);
                    }
                })
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $factories = Factory::all();

        return view('users.create', compact('positions', 'factories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required',
            'password' => 'required|confirmed',
            'position' => 'required|exists:positions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Create staff
        $staff = new Staff();
        $staff->user_id = $user->id;
        $staff->position_id = $request->input('position');
        $staff->work_schedule = "";
        $staff->factory_id = $request->input('factory_id');
        // Set other fields as needed
        $staff->save();

        $position = Position::find($staff->position_id);

        if ($position->role_id > 1) {
            $role =  Role::where('id', $position->role_id)->first();

            $user->assignRole([$role->id]);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $positions = Position::pluck('name', 'id');
        $factories = Factory::all();

        return view('users.edit', compact('user', 'positions', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $staff = $user->staff;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $staff->position_id = $request->input('position_id');
        $staff->factory_id = $request->input('factory_id');

        $user->save();
        $staff->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
