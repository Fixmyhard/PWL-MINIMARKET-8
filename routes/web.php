<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
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

        

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [BranchController::class, 'redirectDashboard'])->name('dashboard');
    Route::get('/dashboard/owner', [BranchController::class, 'dashboardOwner'])->name('dashboard.owner');
    Route::get('/dashboard/manager', function () {
        return view('manager.dashboard');
    })->name('dashboard.manager');
    Route::get('/dashboard/supervisor', function () {
        return view('supervisor.dashboard');
    })->name('dashboard.supervisor');
    Route::get('/dashboard/kasir', function () {
        return view('kasir.dashboard');
    })->name('dashboard.kasir');
    Route::get('/dashboard/gudang', function () {
        return view('gudang.dashboard');
    })->name('dashboard.gudang');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/auth.php';

