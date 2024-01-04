<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UrlGenerateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

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
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return "Cache cleared successfully";
});

Route::get('/', [HomeController::class, 'home'])->name('homepage');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login/store', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register-store', [RegisterController::class, 'store'])->name('register.store');



Route::get('eamil/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
Route::get('forgot-password', [ResetPasswordController::class, 'resetForm'])->name('user.password.get');
Route::post('/forgot-password', [ResetPasswordController::class, 'submitForm'])->name('user.password.post');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('user.password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'is_verify_email'])->name('dashboard');
Route::middleware(['auth', 'is_verify_email'])->group(function () {
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/url-list', [DashboardController::class, 'urlList'])->name('url-list');
    Route::get('/dashboard/url-edit/{id}', [DashboardController::class, 'edit'])->name('url-edit');
    Route::get('/dashboard/url-view/{id?}', [DashboardController::class, 'view'])->name('url-view');
    Route::post('/dashboard/url-delete/{id}', [DashboardController::class, 'delete'])->name('url-delete');
    Route::post('/store', [UrlGenerateController::class, 'store'])->name('url.store');
    Route::get('{shorten}', [UrlGenerateController::class, 'shorten'])->name('url.shorten');
});




