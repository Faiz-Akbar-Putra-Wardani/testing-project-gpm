<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::whereIn('name', ['marketing', 'teknisi'])->get();
        return view('data_user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['marketing', 'teknisi'])->get();
        return view('data_user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('data_user.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit(User $data_user)
{
    $roles = Role::whereIn('name', ['marketing', 'teknisi'])->get();
    return view('data_user.edit', ['user' => $data_user, 'roles' => $roles]);
}

public function update(Request $request, User $data_user)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $data_user->id,
        'role'  => 'required|exists:roles,name',
    ]);

    $data_user->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    $data_user->syncRoles([$request->role]);

    return redirect()->route('data_user.index')->with('success', 'User berhasil diperbarui.');
}

    public function destroy(User $user)
    {
        if ($user->hasRole('owner')) {
            return back()->with('error', 'Tidak bisa menghapus Owner.');
        }

        $user->delete();
        return redirect()->route('data_user.index')->with('success', 'User berhasil dihapus.');
    }
}
