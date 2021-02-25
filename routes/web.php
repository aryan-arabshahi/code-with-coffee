<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{slug}', [HomeController::class, 'getPage'])->name('home.page');
Route::get('/articles', [HomeController::class, 'getArticles'])->name('home.articles');
Route::get('/articles/{name}', [HomeController::class, 'getArticle'])->name('home.article');
