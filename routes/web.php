<?php

use App\Http\Controllers\Dashboard\Servers\CreateServerPageController;
use App\Http\Controllers\Dashboard\Servers\DestroyServerController;
use App\Http\Controllers\Dashboard\Servers\ListServersController;
use App\Http\Controllers\Dashboard\Servers\StoreServerController;
use App\Http\Controllers\Dashboard\Servers\TestServerSSHConnectivityController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




Route::middleware([ 'auth:sanctum'])->group(function () {

    Route::get('/dashboard',function (){
        return inertia('Dashboard');
    })->name('dashboard');
    Route::get('/',function (){
        return inertia('Dashboard');
    })->name('dashboard');

    Route::prefix('servers')->name('servers.')->group(function () {
        Route::get('/', ListServersController::class)->name('index');
        Route::get('/create', CreateServerPageController::class)->name('create');
        Route::post('/', StoreServerController::class)->name('store');
        Route::delete('/{id}', DestroyServerController::class)->name('destroy');

        Route::get('/test-ssh-connectivity/', TestServerSSHConnectivityController::class)->name('test-ssh-connectivity');
    });

});
