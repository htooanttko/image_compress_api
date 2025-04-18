<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::middleware([])->group(function () {
        Route::controller(ImageController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::post('/', 'store');
        });
    });
});
