<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('owner')) {
            return view('dashboard.owner.dashboard'); // View untuk Owner
        } elseif ($user->hasAnyRole(['manager', 'supervisor', 'kasir', 'gudang'])) {
            $branches = $user->cabang; // Ambil cabang pengguna
            return view('dashboard.branch.dashboard', compact('branches')); // View untuk cabang terkait
        }

        return redirect('/')->with('error', 'Access Denied'); // Redirect jika tidak memiliki akses
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
