<?php

use App\Http\Controllers\Dashboard\Servers\CreateServerPageController;
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

Route::get('servers', ListServersController::class)->name('servers.index');
Route::get('/servers/create', CreateServerPageController::class)->name('servers.create');
Route::post('/servers', StoreServerController::class)->name('servers.store');
