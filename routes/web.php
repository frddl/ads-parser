<?php

use App\Http\Controllers\AdItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/new', [AdItemController::class, 'create'])->name('create-item');

    Route::get('/{ad}', [AdItemController::class, 'edit'])->name('edit-item');
    Route::post('/{ad}', [AdItemController::class, 'update'])->name('view-item');
    Route::post('/{ad}/delete', [AdItemController::class, 'destroy'])->name('delete-item');

    Route::get('/{ad}/results', [ResultController::class, 'view'])->name('results');
    Route::get('/{ad}/results/{result}/link', [ResultController::class, 'link'])->name('result-link');
    Route::post('/{ad}/results/{result}/delete', [ResultController::class, 'destroy'])->name('delete-result');
});

require __DIR__ . '/auth.php';
