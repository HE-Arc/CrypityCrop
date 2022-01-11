<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TestController;
use App\Http\Controllers\UsersVaultsController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\PasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::resource('/passwords', PasswordController::class)->middleware(['auth', 'verified']);
Route::resource('/folders', FolderController::class)->middleware(['auth', 'verified']);
Route::resource('/vaults', VaultController::class)->middleware(['auth', 'verified']);
Route::resource('/usersvaults', UsersVaultsController::class)->middleware(['auth', 'verified']);

Route::post('/usersvaults/shareVaultWithEmail', [UsersVaultsController::class, 'shareVaultWithEmail'])->name('usersvaults.shareVaultWithEmail')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
