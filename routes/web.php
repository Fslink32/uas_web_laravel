<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

include 'admin.php';
include 'user.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::resource('user', UserController::class)->middleware(['auth', 'admin']);
// Route::resource('/admin/user', UserController::class)->names([
//     'index' => 'users.pendanaan.index',
//     'store' => 'users.pendanaan.store',
//     'show' => 'users.pendanaan.show',
//     'edit' => 'users.pendanaan.edit',
//     'update' => 'users.pendanaan.update',
//     'destroy' => 'users.pendanaan.destroy',
// ]);

// Auth
// Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('logged_in');
Route::get('logout', [AuthController::class, 'signOut'])->name('signout');
// Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');

