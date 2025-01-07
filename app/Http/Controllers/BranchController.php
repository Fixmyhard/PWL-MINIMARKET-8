<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    // Redirect to dashboard
    public function redirectDashboard()
    {
        // Logika untuk menentukan redirect berdasarkan peran pengguna
        $userRole = auth()->user()->role; // Ambil role pengguna dari model User

        switch ($userRole) {
            case 'manager':
                return redirect()->route('dashboard.manager');
            case 'supervisor':
                return redirect()->route('dashboard.supervisor');
            case 'kasir':
                return redirect()->route('dashboard.kasir');
            case 'gudang':
                return redirect()->route('dashboard.gudang');
            default:
                return redirect()->route('dashboard.owner');
        }
    }

    // Dashboard for owner
    public function dashboardOwner(Request $request)
    {
        $branches = Branch::all(); // Ambil semua cabang untuk pilihan
        $selectedBranchId = $request->input('branch');
        $selectedBranch = $selectedBranchId ? Branch::find($selectedBranchId) : null;
    
        return view('owner.dashboard', [
            'title' => 'Owner Dashboard',
            'branches' => $branches,
            'selectedBranch' => $selectedBranch,
        ]);
    }
    
    // Dashboard for specific roles
    public function dashboardRole(Request $request)
    {
        $userRole = auth()->user()->role; // Ambil role pengguna

        $view = match ($userRole) {
            'manager' => 'manager.dashboard',
            'supervisor' => 'supervisor.dashboard',
            'kasir' => 'kasir.dashboard',
            'gudang' => 'gudang.dashboard',
        };

        return view($view, [
            'title' => ucfirst($userRole) . ' Dashboard',
        ]);
    }
}
