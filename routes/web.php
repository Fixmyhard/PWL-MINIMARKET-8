<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function  () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard/manager/{branch}', [DashboardController::class, 'show'])
//     ->middleware(['auth', 'role:manager|supervisor|kasir|gudang'])
//     ->name('role.dashboardRole');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [BranchController::class, 'redirectDashboard'])->name('dashboard');
    Route::get('/dashboard/owner', [BranchController::class, 'dashboardOwner'])->name('dashboard.owner');
    Route::get('/dashboard/manager', [BranchController::class, 'dashboardManager'])->name('dashboard.manager');
    Route::get('/dashboard/supervisor', [BranchController::class, 'dashboardSupervisor'])->name('dashboard.supervisor');
    Route::get('/dashboard/kasir', [BranchController::class, 'dashboardKasir'])->name('dashboard.kasir');
    Route::get('/dashboard/gudang', [BranchController::class, 'dashboardGudang'])->name('dashboard.gudang');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
    // Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::post('/owner/select-branch', [OwnerController::class, 'selectBranch'])->name('owner.selectBranch');
    Route::get('/owner/create-user', [OwnerController::class, 'createUser'])->name('owner.createUser');
    Route::post('/owner/store-user', [OwnerController::class, 'storeUser'])->name('owner.storeUser');
    Route::get('/manager/dashboard/print', [ManagerDashboardController::class, 'print'])->name('manager.dashboard.print');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
});

Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';

