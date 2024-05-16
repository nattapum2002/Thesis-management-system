<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Welcome

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu_thesis', function () {
    return view('menu_thesis');
});

Route::get('/menu_news', function () {
    return view('menu_news');
});

//Admin

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/add_teacher', function () {
    return view('admin.add_teacher');
});

Route::get('/admin/manage_teacher', function () {
    return view('admin.manage_teacher');
});

Route::get('/admin/manage_member', function () {
    return view('admin.manage_member');
});

Route::get('/admin/edit_admin', function () {
    return view('admin.edit_admin');
});

Route::get('/admin/manage_news', function () {
    return view('admin.manage_news');
});

Route::get('/admin/manage_thesis', function () {
    return view('admin.manage_thesis');
});

Route::get('/admin/admin_project', function () {
    return view('admin.admin_project');
});

Route::get('/admin/manage_exam_schedule', function () {
    return view('admin.manage_exam_schedule');
});

Route::get('/admin/manage_document_schedule', function () {
    return view('admin.manage_document_schedule');
});

Route::get('/admin/admin.approve_documents', function () {
    return view('admin.approve_documents');
});


//Route::get('show', [AdminController::class, 'show']);