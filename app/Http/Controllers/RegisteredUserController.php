<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view_users|add_users|edit_users|delete_users', ['only' => ['index', 'store']]);
        $this->middleware('permission:add_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::pluck('name', 'name')->all();
        return view('users.index', compact('roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'roles' => 'required',
        ]);

        $validatedData['password'] = Hash::make('12345678');
        $validatedData['foto_profil'] = '/img/avatar-1.png';

        $user = User::create($validatedData);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles;
        return view('users.update', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required',
        ]);

        $validatedData['password'] = $user->password;

        $user->update($validatedData);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function updateUser(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' =>  ['required', 'email', Rule::unique('users')->ignore($user->id)]
        ]);

        if ($request->email != $user->email) {
            $validatedData['email'] = $request->email;
        }

        if ($request->file('foto_profil')) {
            if ($user->foto_profil) {
                Storage::delete($user->foto_profil);
            }
            $validatedData['foto_profil'] = $request->file('foto_profil')->store('foto_profil');
        }

        DB::table('users')->where('id', Auth::user()->id)->update($validatedData);

        if ($request->email != $user->email) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        }

        return redirect()->back();

    }
}
