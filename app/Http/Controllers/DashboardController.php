<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Owner')) {
            return view('dashboardOwner'); // Dashboard untuk Owner
        } elseif (Auth::user()->hasAnyRole(['Manager', 'Supervisor', 'Kasir', 'Gudang'])) {
            $branches = Auth::user()->cabang; // Ambil cabang pengguna
            return view('dashboardBranch', compact('branches')); // Dashboard untuk cabang terkait
        }

        return redirect('/'); // Jika tidak memiliki akses, redirect ke halaman utama
    }

    public function show($branch)
    {
        $user = Auth::user();

        // Periksa apakah pengguna memiliki salah satu role yang diizinkan
        if (!$user->hasAnyRole(['manager', 'supervisor', 'kasir', 'gudang'])) {
            return redirect('/home')->with('error', 'You do not have access.');
        }

        return view('role.dashboardRole', ['branch' => $branch]);
    }
}
