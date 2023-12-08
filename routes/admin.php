<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HargaController;
use App\Http\Controllers\admin\PedagangController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware(['auth', 'admin']);
    Route::resource('/admin/user', UserController::class)->names([
        'index' => 'admin.user.index',
        'create' => 'admin.user.create',
        'store' => 'admin.user.store',
        'show' => 'admin.user.show',
        'edit' => 'admin.user.edit',
        'update' => 'admin.user.update',
        'destroy' => 'admin.user.destroy'
    ])->middleware(['auth', 'admin']);
    Route::post('admin/user/dataList', [UserController::class, 'dataList'])->middleware(['auth', 'admin']);
    Route::get('admin/user/reset_password/{user}', [UserController::class, 'reset_password'])->name('admin.user.reset_password')->middleware(['auth', 'admin']);


    Route::resource('/admin/role', RoleController::class)->names([
        'index' => 'admin.role.index',
        'create' => 'admin.role.create',
        'store' => 'admin.role.store',
        'show' => 'admin.role.show',
        'edit' => 'admin.role.edit',
        'update' => 'admin.role.update',
        'destroy' => 'admin.role.destroy'
    ])->middleware(['auth', 'admin']);
    Route::post('admin/role/dataList', [RoleController::class, 'dataList'])->middleware(['auth', 'admin']);
    Route::get('admin/role/privileges/{role}', [RoleController::class, 'privileges'])->name('admin.role.privileges')->middleware(['auth', 'admin']);
    Route::post('admin/role/privileges', [RoleController::class, 'privileges_store'])->name('admin.role.privileges.store')->middleware(['auth', 'admin']);
    Route::get('role/getPrivillege', [RoleController::class, 'getPrivillege'])->name('admin.role.privileges.get')->middleware(['auth', 'admin']);

    Route::resource('/admin/pedagang', PedagangController::class)->names([
        'index' => 'admin.pedagang.index',
        'create' => 'admin.pedagang.create',
        'store' => 'admin.pedagang.store',
        'show' => 'admin.pedagang.show',
        'edit' => 'admin.pedagang.edit',
        'update' => 'admin.pedagang.update',
        'destroy' => 'admin.pedagang.destroy'
    ])->middleware(['auth', 'admin']);
    Route::post('admin/pedagang/dataList', [PedagangController::class, 'dataList'])->middleware(['auth', 'admin']);
    Route::resource('/admin/harga', HargaController::class)->names([
        'index' => 'admin.harga.index',
        'create' => 'admin.harga.create',
        'store' => 'admin.harga.store',
        'show' => 'admin.harga.show',
        'edit' => 'admin.harga.edit',
        'update' => 'admin.harga.update',
        'destroy' => 'admin.harga.destroy'
    ])->middleware(['auth', 'admin']);
    Route::post('admin/harga/dataList', [HargaController::class, 'dataList'])->middleware(['auth', 'admin']);
});
