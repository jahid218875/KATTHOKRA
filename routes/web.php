<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'login'])->name('loginSubmit');
Route::get('/group/{name}', [HomeController::class, 'group'])->name('group');




Route::name('admin.')->prefix('/panel/admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');


    // Subject Add 
    Route::get('/subject-add', [AdminController::class, 'subject_add'])->name('subject_add');
    Route::post('/subject-add', [AdminController::class, 'subject_add_process'])->name('subject_process');


    // Paper Add 
    Route::get('/paper-add', [AdminController::class, 'paper_add'])->name('paper_add');
    Route::post('/paper-add', [AdminController::class, 'paper_add_process'])->name('paper_process');


    // Chapter add 
    Route::get('/chapter-add', [AdminController::class, 'chapter_add'])->name('chapter_add');
    Route::post('/chapter-add', [AdminController::class, 'chapter_add_process'])->name('chapter_process');


    // Route::get('/subject-list', [AdminController::class, 'subject_list']);
});
