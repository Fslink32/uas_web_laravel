<?php

use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('tentang_pasar', [HomeController::class, 'tentang_pasar'])->name('user.home.tentang_pasar');
Route::get('pedagang', [HomeController::class, 'pedagang'])->name('user.home.pedagang');
Route::get('harga', [HomeController::class, 'harga'])->name('user.home.harga');
Route::get('about', [HomeController::class, 'about'])->name('user.home.about');
Route::get('kontak', [HomeController::class, 'kontak'])->name('user.home.kontak');
