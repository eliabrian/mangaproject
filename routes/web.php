<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ChapterController;
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
    // Auth Routes
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.login.authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        // Manga Routes
        Route::get('/mangas', [MangaController::class, 'index'])->name('admin.manga.index');
        Route::get('/mangas/create', [MangaController::class, 'create'])->name('admin.manga.create');
        Route::post('/mangas', [MangaController::class, 'store'])->name('admin.manga.store');
        Route::get('/mangas/{manga:slug}/edit', [MangaController::class, 'edit'])->name('admin.manga.edit');
        Route::put('/mangas/{manga:slug}', [MangaController::class, 'update'])->name('admin.manga.update');
        
        // Chapter Routes
        Route::get('mangas/{manga:slug}/chapters/create', [ChapterController::class, 'create'])->name('admin.chapter.create');
        Route::post('/chapters', [ChapterController::class, 'store'])->name('admin.chapter.store');
        Route::get('mangas/{manga:slug}/chapters/{chapter:slug}/edit', [ChapterController::class, 'edit'])->name('admin.chapter.edit');
        Route::put('/chapters/{chapter:slug}', [ChapterController::class, 'update'])->name('admin.chapter.update');
    });
    
    Route::any('/mangas/ajax', [MangaController::class, 'ajax']);
    Route::any('/chapters/ajax', [MangaController::class, 'chapterAjax']);
});