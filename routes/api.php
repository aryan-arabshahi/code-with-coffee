<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TicketController;
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

/**
 * Guarded Routes
 */
Route::middleware('auth:api')->group(function () {

    Route::prefix('/categories')->group(function () {
        Route::post('/', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/', [CategoryController::class, 'list'])->name('categories.list');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::patch('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/{id}', [CategoryController::class, 'get'])->name('categories.get');
    });

    Route::prefix('/articles')->group(function () {
        Route::post('/', [ArticleController::class, 'create'])->name('articles.create');
        Route::patch('/{id}', [ArticleController::class, 'update'])->name('articles.update');
        Route::get('/', [ArticleController::class, 'list'])->name('articles.list');
        Route::delete('/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
        Route::get('/{id}', [ArticleController::class, 'get'])->name('articles.get');
    });

    Route::prefix('/pages')->group(function () {
        Route::post('/', [PageController::class, 'create'])->name('pages.create');
        Route::patch('/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::get('/', [PageController::class, 'list'])->name('pages.list');
        Route::get('/{id}', [PageController::class, 'get'])->name('pages.get');
        Route::delete('/{id}', [PageController::class, 'delete'])->name('pages.delete');
    });

    Route::prefix('/subscribers')->group(function () {
        Route::get('/', [SubscriptionController::class, 'getSubscribers'])->name('subscribers.list');
    });

    Route::prefix('/tickets')->group(function () {
        Route::get('/', [TicketController::class, 'list'])->name('tickets.list');
        Route::get('/{id}', [TicketController::class, 'get'])->name('tickets.get');
        Route::delete('/{id}', [TicketController::class, 'delete'])->name('tickets.delete');
    });

});


/**
 * Public Routes
 */

Route::prefix('/newsletter')->group(function () {
    Route::post('/subscribe', [SubscriptionController::class, 'postSubscribe'])
        ->name('newsletter.subscribe')
        ->middleware('throttle:6,1');
});

Route::prefix('/storage')->group(function () {
    Route::get(
        '/{module}/image/{id}/{name?}/{width?}/{height?}',
        [StorageController::class, 'getImage']
    )->name('storage.getImage');
});

Route::post('/ticket', [TicketController::class, 'create'])
    ->name('tickets.create')
    ->middleware('throttle:6,1');
