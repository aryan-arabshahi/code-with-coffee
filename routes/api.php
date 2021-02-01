<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function () {

    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'list'])->name('categories.list');
        Route::post('/', [CategoryController::class, 'create'])->name('categories.create');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::patch('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/{id}', [CategoryController::class, 'get'])->name('categories.get');
    });

});

