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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// TODO: Check what ->name('dashboard') does
Route::get('/test', [TestController::class, 'index'])->name('test.index')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/usersvaults', [UsersVaultsController::class, 'index'])->name('usersvaults.index')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/vaults', [VaultController::class, 'index'])->name('vaults.index')->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/folders', [FolderController::class, 'index'])->name('folders.index')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index')->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/folders', FolderController::class)->middleware(['auth', 'verified']);
Route::resource('/passwords', PasswordController::class)->middleware(['auth', 'verified']);
Route::resource('/vaults', VaultController::class)->middleware(['auth', 'verified']);
//Route::post('/folders/insertion/{}')

require __DIR__.'/auth.php';
