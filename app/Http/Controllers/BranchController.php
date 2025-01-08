<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    // Redirect to dashboard
    public function redirectDashboard()
    {
        $userRole = auth()->user()->role; // Ambil role pengguna dari model User
        Log::info('User role: ' . $userRole); // Log the user role

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
        $viewPath = strtolower($userRole) . '.dashboard';
        return view($viewPath, ['role' => $userRole]);
        return view('dashboard.role', ['role' => $userRole]);
    }

    // Show the form for creating a new branch
    public function create()
    {
        return view('branch.create');
    }

    // Store a newly created branch in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Branch::create($request->all());

        return redirect()->route('branch.create')->with('success', 'Branch created successfully.');
    }

    // Show the form for editing the specified branch
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }

    // Update the specified branch in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect()->route('branch.edit', $id)->with('success', 'Branch updated successfully.');
    }

    // Remove the specified branch from storage
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('dashboard')->with('success', 'Branch deleted successfully.');
    }
}