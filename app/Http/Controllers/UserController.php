<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Factory;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
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

            if (Auth::user()->hasRole(['Operator'])) {
                $user = Auth::user();
                $user2 = User::find($user->id);
                $users->where('factories.id', $user2->staff->factory_id);
            }

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm mx-1">Ubah</a>' .
                        '<a href="' . route('users.show', $user->id) . '" class="btn btn-primary btn-sm mx-1">Lihat</a>'.
                        '<button class="btn btn-primary btn-sm mx-1 act-change-password" data-id="'.$user->id.'">Ganti Password</button>';
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
    public function create(): View
    {
        $positions = Position::all();
        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();

        return view('users.create', compact('positions', 'factories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
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

        if ($position->role_id > 0) {
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
    public function show($id): View
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
    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $positions = Position::pluck('name', 'id');
        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();

        return view('users.edit', compact('user', 'positions', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
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

    public function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function changePassword(Request $request)
    {
        $newPassword = $request->input('newPassword');
        $confirmPassword = $request->input('confirmPassword');
        $userId = $request->input('userId');

        if ($newPassword === $confirmPassword) {
           $user = User::find($userId);
           $user->password = Hash::make($newPassword);
           $user->save();


           return response()->json(['message' => 'Password changed successfully']);
        } else {
            return response()->json(['error' => 'Password and confirm password do not match'], 400);
        }
    }

    public function showChangePasswordForm($id)
    {
        $user = User::find($id);

        return view('changePassword.edit',compact('user'));
    }

    public function selfUpdatePassword(Request $request, int $id)
    {
        $this->validate($request, [
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('dashboard.index', $id)
                        ->with('message','Password berhasil diubah');
    }
}
