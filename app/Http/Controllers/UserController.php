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
            'email' => 'nullable|email|unique:users',
            'role' => 'required|in:super_admin,admin'
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'Akun admin baru berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'phone' => 'nullable',
            'email' => 'nullable|email|unique:users,email,'.$id,
            'role' => 'required|in:super_admin,admin',
            'password' => 'nullable|min:6'
        ]);

        $user = User::findOrFail($id);
        if ($user->id === auth()->id() && $request->role !== auth()->user()->role) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role akun sendiri!');
        }
        $data = [
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Data akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }
}
