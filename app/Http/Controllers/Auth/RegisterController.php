<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UpdateUser;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        $branches = Branch::all(); // Ambil semua cabang
        return view('auth.register', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'peran' => 'required|string',
            'email' => 'required|string|email|max:255|unique:update_users',
            'password' => 'required|string|min:8|confirmed',
            'id_cabang' => 'nullable|exists:branches,id',
        ]);

        UpdateUser::create([
            'nama_user' => $request->nama_user,
            'peran' => $request->peran,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_cabang' => $request->id_cabang,
        ]);

        return redirect()->route('login')->with('success', 'Account registered successfully!');
    }
}
