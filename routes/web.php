<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
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
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/hsc-and-admission', [HomeController::class, 'hsc_admission'])->name('hsc_admission');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::post('/login', [HomeController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/engineering', [HomeController::class, 'engineering'])->name('engineering');

Route::get('/group/{name}', [HomeController::class, 'group'])->name('group');

Route::get('forgot', [HomeController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forgot', [HomeController::class, 'forgot'])->name('forgot');

// Route::get('/group/{name}', [HomeController::class, 'group'])->name('group');

// Route::get('/group/{name}/{subject}', [HomeController::class, 'reader'])->name('reader');
// Route::post('/paper-to-chapter', [HomeController::class, 'paper_to_chapter'])->name('paper_to_chapter');
// Route::post('/chapter-to-type', [HomeController::class, 'chapter_to_type'])->name('chapter_to_type');
// Route::post('/type-to-content', [HomeController::class, 'type_to_content'])->name('type_to_content');

// Route::get('/reader', [HomeController::class, 'reader'])->name('reader');


Route::get('/manager', [AdminController::class, 'login'])->name('manager.login');
Route::post('/manager', [AdminController::class, 'loginSubmit'])->name('manager.login');
Route::get('/manager/logout', [AdminController::class, 'logout'])->name('manager.logout');


//check auth middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
    Route::post('/signup', [HomeController::class, 'signupData'])->name('signupData');

    // HSC Reader 
    Route::get('/group/{name}/{subject}', [HomeController::class, 'reader'])->name('reader');
    Route::post('/paper-to-chapter', [HomeController::class, 'paper_to_chapter'])->name('paper_to_chapter');
    Route::post('/chapter-to-type', [HomeController::class, 'chapter_to_type'])->name('chapter_to_type');
    Route::post('/type-to-content', [HomeController::class, 'type_to_content'])->name('type_to_content');

    // engineering reader 
    Route::get('/engineering/{subject}', [HomeController::class, 'engineering_reader'])->name('engineering_reader');
    Route::post('/engineering-chapter-to-type', [HomeController::class, 'engineering_chapter_to_type'])->name('engineering_chapter_to_type');
    Route::post('/engineering-type-to-content', [HomeController::class, 'engineering_type_to_content'])->name('engineering_type_to_content');
});

Route::group(['middleware' => ['auth:admin']], function () {

    Route::name('admin.')->prefix('/panel/admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Editor Add 
        Route::get('/editor-add', [AdminController::class, 'editor_add'])->name('editor_add');
        Route::post('/editor-add', [AdminController::class, 'editor_add_process'])->name('editor_process');
        Route::get('/editor-delete/{id}', [AdminController::class, 'editor_delete'])->name('editor_delete');

        // Teacher Add for Home page
        Route::get('/teacher-add', [AdminController::class, 'teacher_add'])->name('teacher_add');
        Route::post('/teacher-add', [AdminController::class, 'teacher_add_process'])->name('teacher_process');
        Route::get('/teacher-delete/{id}', [AdminController::class, 'teacher_delete'])->name('teacher_delete');

        // Ads Add for Home page
        Route::get('/ads', [AdminController::class, 'ads'])->name('ads');
        Route::post('/ads_process', [AdminController::class, 'ads_process'])->name('ads_process');
        Route::get('/ads-delete/{id}', [AdminController::class, 'ads_delete'])->name('ads_delete');


        // Review Add 
        Route::get('/review-add', [AdminController::class, 'review_add'])->name('review_add');
        Route::post('/review-add', [AdminController::class, 'review_add_process'])->name('review_process');
        Route::get('/review-delete/{id}', [AdminController::class, 'review_delete'])->name('review_delete');


        // HSC & Admission Subject Add 
        Route::get('/subject-add', [AdminController::class, 'subject_add'])->name('subject_add');
        Route::post('/subject-add', [AdminController::class, 'subject_add_process'])->name('subject_process');
        Route::get('/subject-edit/{id}', [AdminController::class, 'subject_edit'])->name('subject_edit');
        Route::post('/subject-update/{id}', [AdminController::class, 'subject_update'])->name('subject_update');
        Route::get('/subject-delete/{id}', [AdminController::class, 'subject_delete'])->name('subject_delete');


        // HSC & Admission Paper Add 
        Route::get('/paper-add', [AdminController::class, 'paper_add'])->name('paper_add');
        Route::post('/paper-add', [AdminController::class, 'paper_add_process'])->name('paper_process');
        Route::get('/paper-delete/{id}', [AdminController::class, 'paper_delete'])->name('paper_delete');


        // HSC & Admission Chapter add 
        Route::get('/chapter-add', [AdminController::class, 'chapter_add'])->name('chapter_add');

        Route::post('/chapter-add', [AdminController::class, 'chapter_add_process'])->name('chapter_process');

        Route::post('/chapter-add-submit', [AdminController::class, 'chapter_add_submit'])->name('chapter_submit');

        Route::get('/chapter-delete/{id}', [AdminController::class, 'chapter_delete'])->name('chapter_delete');


        // HSC & Admission Type add

        Route::get('/type-add', [AdminController::class, 'type_add'])->name('type_add');

        Route::post('/type-add', [AdminController::class, 'type_add_process'])->name('type_process');

        Route::post('/type-add-submit', [AdminController::class, 'type_add_submit'])->name('type_submit');

        Route::get('/type-delete/{id}', [AdminController::class, 'type_delete'])->name('type_delete');

        // HSC & Admission Content List 

        Route::get('/hsc-content-list', [AdminController::class, 'hsc_content_list'])->name('hsc_content_list');
        Route::get('/hsc-content-edit/{id}', [AdminController::class, 'hsc_content_edit'])->name('hsc_content_edit');
        Route::post('/hsc-content-update/{id}', [AdminController::class, 'hsc_content_update'])->name('hsc_content_update');
        Route::get('/hsc-content-delete/{id}', [AdminController::class, 'hsc_content_delete'])->name('hsc_content_delete');

        //  Engineering Subject Add 
        Route::get('/engineering-subject-add', [AdminController::class, 'engineering_subject_add'])->name('engineering_subject_add');
        Route::post('/engineering-subject-add', [AdminController::class, 'engineering_subject_process'])->name('engineering_subject_process');
        Route::get('/engineering-subject-edit/{id}', [AdminController::class, 'engineering_subject_edit'])->name('engineering_subject_edit');
        Route::post('/engineering-subject-update/{id}', [AdminController::class, 'engineering_subject_update'])->name('engineering_subject_update');
        Route::get('/engineering-subject-delete/{id}', [AdminController::class, 'engineering_subject_delete'])->name('engineering_subject_delete');

        // Engineering Chapter add 
        Route::get('/engineering-chapter-add', [AdminController::class, 'engineering_chapter_add'])->name('engineering_chapter_add');

        Route::post('/engineering-chapter-submit', [AdminController::class, 'engineering_chapter_submit'])->name('engineering_chapter_submit');

        Route::get('/engineering-chapter-delete/{id}', [AdminController::class, 'engineering_chapter_delete'])->name('engineering_chapter_delete');

        // Engineering Type add

        Route::get('/engineering-type-add', [AdminController::class, 'engineering_type_add'])->name('engineering_type_add');

        Route::post('/engineering-type-add', [AdminController::class, 'engineering_type_process'])->name('engineering_type_process');

        Route::post('/engineering-type-add-submit', [AdminController::class, 'engineering_type_submit'])->name('engineering_type_submit');

        Route::get('/type-delete/{id}', [AdminController::class, 'engineering_type_delete'])->name('engineering_type_delete');


        // Engineering Content List 

        Route::get('/engineering-content-list', [AdminController::class, 'engineering_content_list'])->name('engineering_content_list');
        Route::get('/engineering-content-edit/{id}', [AdminController::class, 'engineering_content_edit'])->name('engineering_content_edit');
        Route::post('/engineering-content-update/{id}', [AdminController::class, 'engineering_content_update'])->name('engineering_content_update');
        Route::get('/engineering-content-delete/{id}', [AdminController::class, 'engineering_content_delete'])->name('engineering_content_delete');
    });
});

Route::group(['middleware' => ['auth:editor']], function () {

    Route::name('editor.')->prefix('/panel/editor')->group(function () {

        Route::get('/dashboard', [EditorController::class, 'dashboard'])->name('dashboard');

        // HSC content add

        Route::get('/content-add', [EditorController::class, 'content_add'])->name('content_add');
        Route::post('/paper-process', [EditorController::class, 'paper_process'])->name('paper_process');
        Route::post('/chapter-process', [EditorController::class, 'chapter_process'])->name('chapter_process');
        Route::post('/type-process', [EditorController::class, 'type_process'])->name('type_process');
        Route::post('/hsc-content-submit', [EditorController::class, 'hsc_content_submit'])->name('hsc_content_submit');


        Route::get('/hsc-content-list', [EditorController::class, 'hsc_content_list'])->name('hsc_content_list');
        Route::get('/hsc-content-edit/{id}', [EditorController::class, 'hsc_content_edit'])->name('hsc_content_edit');
        Route::post('/hsc-content-update/{id}', [EditorController::class, 'hsc_content_update'])->name('hsc_content_update');


        // Engineering content add

        Route::get('/engineering-content-add', [EditorController::class, 'engineering_content_add'])->name('engineering_content_add');
        Route::post('/engineering-chapter-process', [EditorController::class, 'engineering_chapter_process'])->name('engineering_chapter_process');
        Route::post('/engineering-type-process', [EditorController::class, 'engineering_type_process'])->name('engineering_type_process');
        Route::post('/engineering-content-submit', [EditorController::class, 'engineering_content_submit'])->name('engineering_content_submit');

        Route::get('/engineering-content-list', [EditorController::class, 'engineering_content_list'])->name('engineering_content_list');
        Route::get('/engineering-content-edit/{id}', [EditorController::class, 'engineering_content_edit'])->name('engineering_content_edit');
        Route::post('/engineering-content-update/{id}', [EditorController::class, 'engineering_content_update'])->name('engineering_content_update');

        // Engineering Chapter add 
        // Route::get('/engineering-chapter-add', [EditorController::class, 'engineering_chapter_add'])->name('engineering_chapter_add');

        // Route::post('/engineering-chapter-submit', [EditorController::class, 'engineering_chapter_submit'])->name('engineering_chapter_submit');

        // Route::get('/engineering-chapter-delete/{id}', [EditorController::class, 'engineering_chapter_delete'])->name('engineering_chapter_delete');
    });
});
