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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/group/{name}', [HomeController::class, 'group']);




Route::name('admin.')->prefix('/panel/admin')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    // Subject Add 

    Route::get('/subject-add', [HomeController::class, 'subject_add'])->name('subject_add');
    Route::post('/subject-add', [HomeController::class, 'subject_add_process'])->name('subject_process');

    // Paper Add 

    Route::get('/paper-add', [HomeController::class, 'paper_add'])->name('paper_add');


    Route::get('/subject-list', [HomeController::class, 'subject_list']);
});
