<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Transaction;
use App\Models\Stock;
use App\Models\User;

class OwnerController extends Controller
{

    public function index()
    {
        $branches = Branch::all();
        $transactions = Transaction::all();
        $stocks = Stock::all();
        return view('owner.dashboard', compact('branches', 'transactions', 'stocks'));
    }

    public function dashboard()
    {
        $branches = Branch::all();
        $transactions = Transaction::with('branch')->get();
        $stocks = Stock::with('product', 'branch')->get();
        return view('owner.dashboard', compact('branches', 'transactions', 'stocks'));
    }

    public function selectBranch(Request $request)
    {
        $request->session()->put('branch_id', $request->branch_id);
        return redirect()->route('owner.dashboard');
    }

    public function createUser()
    {
        return view('owner.createUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'branch_id' => session('branch_id')
        ]);

        return redirect()->route('owner.dashboard');
    }

    // Add methods for transactions and stock checking
}
