<?php

use App\Http\Controllers\Dashboard\Servers\CreateServerPageController;
use App\Http\Controllers\Dashboard\Servers\DestroyServerController;
use App\Http\Controllers\Dashboard\Servers\ListServersController;
use App\Http\Controllers\Dashboard\Servers\StoreServerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('servers')->name('servers.')->group(function () {
    Route::get('/', ListServersController::class)->name('index');
    Route::get('/create', CreateServerPageController::class)->name('create');
    Route::post('/', StoreServerController::class)->name('store');
    Route::delete('/{id}', DestroyServerController::class)->name('destroy');
});
