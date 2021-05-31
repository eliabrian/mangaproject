<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\MangaController;

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

Route::get('/admin', function () {
    return view('admin.manga.index');
});


Route::prefix('admin')->group(function () {
    Route::get('/mangas', [MangaController::class, 'index']);
    Route::any('/mangas/ajax', [MangaController::class, 'ajax']);
});