<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super_admin')->except(['index', 'show']);
    }

    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable',
            'role' => 'required|in:super_admin,admin'
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'Akun berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'phone' => 'nullable',
            'role' => 'required|in:super_admin,admin',
            'password' => 'nullable|min:6'
        ]);

        $user = User::findOrFail($id);
        $data = [
            'username' => $request->username,
            'phone' => $request->phone,
            'role' => $request->role
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }
}
