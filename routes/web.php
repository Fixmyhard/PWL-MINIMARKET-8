<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\GudangController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk autentikasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    // Branch Routes
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
    
    // Dashboard Routes
    Route::get('/dashboard', [BranchController::class, 'redirectDashboard'])->name('dashboard');
    Route::get('/dashboard/owner', [BranchController::class, 'dashboardOwner'])->name('dashboard.owner');
    Route::get('/dashboard/manager', [BranchController::class, 'dashboardManager'])->name('dashboard.manager');
    Route::get('/dashboard/supervisor', [BranchController::class, 'dashboardSupervisor'])->name('dashboard.supervisor');
    Route::get('/dashboard/kasir', [BranchController::class, 'dashboardKasir'])->name('dashboard.kasir');
    Route::get('/dashboard/gudang', [BranchController::class, 'dashboardGudang'])->name('dashboard.gudang');
    
    // Owner Routes
    Route::post('/owner/select-branch', [OwnerController::class, 'selectBranch'])->name('owner.selectBranch');
    Route::get('/owner/create-user', [OwnerController::class, 'createUser'])->name('owner.createUser');
    Route::post('/owner/store-user', [OwnerController::class, 'storeUser'])->name('owner.storeUser');
    
    // Manager Routes
    Route::get('/manager/dashboard/print', [ManagerController::class, 'print'])->name('manager.dashboard.print');
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/print-report', [ManagerController::class, 'printReport'])->name('print.report.manager');
    
    // Kasir Routes
    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    
    // Transaction Routes
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
});

// Owner Dashboard Routes
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index']);
});

// Gudang Routes
Route::prefix('gudang')->name('gudang.')->group(function () {
    // Route untuk melihat dashboard gudang
    Route::get('/dashboard', [GudangController::class, 'index'])->name('dashboard'); // Menggunakan metode index
    // Route untuk membuat produk baru
    Route::get('/create', [GudangController::class, 'create'])->name('create');
    Route::delete('/stock/{id}', [GudangController::class, 'delete'])->name('delete');
    Route::post('/store', [GudangController::class, 'store'])->name('store');
    
});

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Authentication Routes
require __DIR__.'/auth.php';
