<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

 Route::get('/customer', function () {
    return Customer::all();
 });

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('/', [ConnectionController::class, 'index'])->name('home');
Route::post('/set-locale', [ConnectionController::class, 'setLocale'])->name('set-locale');

Route::post('/vaucher', [ConnectionController::class, 'checkVacherPage'])->name('checkVacherPage');
Route::post('/connect', [ConnectionController::class, 'connect'])->name('connect');
Route::get('/get-voucher', [ConnectionController::class, 'getVoucher'])->name('getvoucher');
Route::get('/ads', [AdsController::class, 'view'])->name('ads.view');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    // Admin Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Language Management
    Route::get('languages', [LanguageController::class, 'index'])->name('admin.languages.index');
    Route::post('languages', [LanguageController::class, 'store'])->name('admin.languages.store');
    Route::post('languages/{language}', [LanguageController::class, 'update'])->name('admin.languages.update');
    Route::get('languages/{language}/edit', [LanguageController::class, 'edit'])->name('admin.languages.edit');
    Route::delete('languages/{language}', [LanguageController::class, 'destroy'])->name('admin.languages.destroy');

    // Translation Management
    Route::resource('translations', TranslationController::class);
    Route::post('translations-update', [TranslationController::class, 'updatestring'])->name('translations_update');
    Route::resource('settings', SettingsController::class);

    Route::resource('ads', AdsController::class);
    Route::get('/status/{status}/{ad}', [AdsController::class, 'status'])->name('admin.ads.status');
});
