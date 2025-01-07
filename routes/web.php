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
        Route::get('/dashboard/manager', [BranchController::class, 'dashboardRole'])->name('dashboard.manager');
        Route::get('/dashboard/supervisor', [BranchController::class, 'dashboardRole'])->name('dashboard.supervisor');
        Route::get('/dashboard/kasir', [BranchController::class, 'dashboardRole'])->name('dashboard.kasir');
        Route::get('/dashboard/gudang', [BranchController::class, 'dashboardRole'])->name('dashboard.gudang');
        Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
        Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    });


require __DIR__.'/auth.php';

        