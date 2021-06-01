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

Route::prefix('admin')->group(function () {
    // Manga Routes
    Route::get('/mangas', [MangaController::class, 'index'])->name('admin.manga.index');
    Route::get('/mangas/create', [MangaController::class, 'create'])->name('admin.manga.create');
    Route::post('/mangas', [MangaController::class, 'store'])->name('admin.manga.store');
    Route::get('/mangas/{manga:slug}/edit', [MangaController::class, 'edit'])->name('admin.manga.edit');
    Route::put('/mangas/{manga:slug}', [MangaController::class, 'update'])->name('admin.manga.update');
    Route::any('/mangas/ajax', [MangaController::class, 'ajax']);
});