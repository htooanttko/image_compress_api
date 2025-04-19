<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('/compress')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(ImageController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::post('/', 'compress');
        });
    });
});
