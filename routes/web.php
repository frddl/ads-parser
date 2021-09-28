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

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('ads')->group(function () {
        Route::get('/new', [AdItemController::class, 'create'])->name('create-item');
        Route::post('/new', [AdItemController::class, 'store'])->name('item-store');

        Route::get('/{adItem}', [AdItemController::class, 'edit'])->name('edit-item');
        Route::post('/{adItem}', [AdItemController::class, 'update'])->name('view-item');
        Route::post('/{adItem}/delete', [AdItemController::class, 'destroy'])->name('delete-item');

        Route::get('/{adItem}/results', [ResultController::class, 'view'])->name('item-results');
        Route::get('/{adItem}/results/{result}/link', [ResultController::class, 'link'])->name('result-link');
        Route::post('/{adItem}/results/{result}/delete', [ResultController::class, 'destroy'])->name('delete-result');
    });

    Route::get('/results', [ResultController::class, 'index'])->name('results');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [DashboardController::class, 'settingsStore'])->name('settings-store');
});
