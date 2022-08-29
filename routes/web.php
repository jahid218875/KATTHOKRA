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
Route::post('/login', [HomeController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/group/{name}', [HomeController::class, 'group'])->name('group');




//check auth middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
    Route::post('/signup', [HomeController::class, 'signupData'])->name('signupData');
});

Route::get('/manager', [AdminController::class, 'login'])->name('manager.login');

Route::name('admin.')->prefix('/panel/admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Subject Add 
    Route::get('/subject-add', [AdminController::class, 'subject_add'])->name('subject_add');
    Route::post('/subject-add', [AdminController::class, 'subject_add_process'])->name('subject_process');
    Route::get('/subject-delete/{id}', [AdminController::class, 'subject_delete'])->name('subject_delete');


    // Paper Add 
    Route::get('/paper-add', [AdminController::class, 'paper_add'])->name('paper_add');
    Route::post('/paper-add', [AdminController::class, 'paper_add_process'])->name('paper_process');
    Route::get('/paper-delete/{id}', [AdminController::class, 'paper_delete'])->name('paper_delete');


    // Chapter add 
    Route::get('/chapter-add', [AdminController::class, 'chapter_add'])->name('chapter_add');

    Route::post('/chapter-add', [AdminController::class, 'chapter_add_process'])->name('chapter_process');

    Route::post('/chapter-add-submit', [AdminController::class, 'chapter_add_submit'])->name('chapter_submit');

    Route::get('/chapter-delete/{id}', [AdminController::class, 'chapter_delete'])->name('chapter_delete');


    // Type add

    Route::get('/type-add', [AdminController::class, 'type_add'])->name('type_add');

    Route::post('/type-add', [AdminController::class, 'type_add_process'])->name('type_process');

    Route::post('/type-add-submit', [AdminController::class, 'type_add_submit'])->name('type_submit');

    Route::get('/type-delete/{id}', [AdminController::class, 'type_delete'])->name('type_delete');
});
