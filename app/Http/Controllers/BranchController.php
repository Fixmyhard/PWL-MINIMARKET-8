<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Transaction;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\StockMovement; // Add this line
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class BranchController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $this->authorizeRole(['owner']);
        $branches = Branch::all();
        $selectedBranchId = $request->input('branch');
    $selectedBranch = $selectedBranchId ? Branch::find($selectedBranchId) : null;

    $transactions = $selectedBranch
        ? $selectedBranch->transactions()->get()
        : Transaction::all();

    $stocks = $selectedBranch
        ? $selectedBranch->stocks()->get()
        : Stock::all();

    return view('owner.dashboard', [
        'title' => 'Owner Dashboard',
        'branches' => $branches,
        'selectedBranch' => $selectedBranch,
        'transactions' => $transactions,
        'stocks' => $stocks,
    ]);
    }

    // Dashboard for manager
    public function dashboardManager()
    {
        $this->authorizeRole(['manager']);
        return view('manager.dashboard', ['role' => 'manager']);
    }

    // Dashboard for supervisor
    public function dashboardSupervisor()
    {
        $this->authorizeRole(['supervisor']);
        return view('supervisor.dashboard', ['role' => 'supervisor']);
    }

    // Dashboard for kasir
    public function dashboardKasir()
    {
        $this->authorizeRole(['kasir']);
        $products = Product::all();
        $dailySales = Transaction::whereDate('transaction_date', now()->toDateString())->get();
        $receipts = Receipt::all();

        return view('kasir.dashboard', compact('products', 'dailySales', 'receipts'));
    }

    // Dashboard for gudang
    public function dashboardGudang()
    {
        $this->authorizeRole(['gudang']);
        $stockMovements = StockMovement::all();

        return view('gudang.dashboard', compact('stockMovements'));
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

    // Authorize role
    private function authorizeRole(array $roles)
    {
        $userRole = auth()->user()->role;
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action.');
        }
    }
}