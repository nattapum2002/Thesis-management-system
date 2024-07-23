<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StudentProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DissertationArticleController;
use App\Http\Controllers\CommentListController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConfirmStudentController;
use App\Http\Controllers\ConfirmTeacherController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DocumentSubmissionScheduleController;
use App\Http\Controllers\ExamScheduleController;
use App\Http\Controllers\pdfGenerateController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Auth;
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

//Controllers

Route::resource('levels', LevelController::class);
Route::resource('courses', CourseController::class);
Route::resource('members', MemberController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('projects', ProjectController::class);
Route::resource('positions', PositionController::class);
Route::resource('student-projects', StudentProjectController::class);
Route::resource('students', StudentController::class);
Route::resource('news', NewsController::class);
Route::resource('layouts', LayoutController::class);
Route::resource('documents', DocumentController::class);
Route::resource('dissertation-articles', DissertationArticleController::class);
Route::resource('comment-lists', CommentListController::class);
Route::resource('advisers', AdviserController::class);
Route::resource('comments', CommentController::class);
Route::resource('confirm-students', ConfirmStudentController::class);
Route::resource('confirm-teachers', ConfirmTeacherController::class);
Route::resource('directors', DirectorController::class);
Route::resource('document-submission-schedules', DocumentSubmissionScheduleController::class);
Route::resource('exam-schedules', ExamScheduleController::class);
Route::resource('scores', ScoreController::class);

//Welcome

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu_thesis', function () {
    return view('menu_thesis');
});

Route::get('/detail_thesis/{thesisId}', function ($thesisId) {
    return view('detail_thesis', compact('thesisId'));
});

Route::get('/menu_news', function () {
    return view('menu_news');
});

Route::get('/detail_news/{newsId}', function ($newsId) {
    return view('detail_news', compact('newsId'));
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login_member', function () {
    return view('login_member');
})->name('login_member');

Route::get('/login_teacher', function () {
    return view('login_teacher');
})->name('login_teacher');

Route::get('/logout', function () {
    if (Auth::guard('members')->check()) {
        Auth::guard('members')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login_member');
    } else if (Auth::guard('teachers')->check()) {
        Auth::guard('teachers')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login_teacher');
    }
})->name('logout');

//Global Routes

//Admin Routes

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::get('/admin/add_teacher', function () {
    return view('admin.add_teacher');
});

Route::get('/admin/manage_teacher', function () {
    return view('admin.manage_teacher');
})->name('manage_teacher');

Route::get('/admin/approve_teacher/{teacherId}', function ($teacherId) {
    return view('admin.approve_teacher', compact('teacherId'));
});

Route::get('/admin/manage_member', function () {
    return view('admin.manage_member');
})->name('manage_member');

Route::get('/admin/approve_member/{studentId}', function ($studentId) {
    return view('admin.approve_member', compact('studentId'));
});

Route::get('/admin/edit_admin', function () {
    return view('admin.edit_admin');
});

Route::get('/admin/manage_news', function () {
    return view('admin.manage_news');
})->name('manage_news');

Route::get('/admin/add_news', function () {
    return view('admin.add_news');
});

Route::get('/admin/edit_and_detail_news/{newsId}', function ($newsId) {
    return view('admin.edit_and_detail_news', compact('newsId'));
});

Route::get('/admin/approve_news', function () {
    return view('admin.approve_news');
});

Route::get('/admin/menu_news_login', function () {
    return view('admin.menu_news_login');
});

Route::get('/admin/detail_news_login/{newsId}', function ($newsId) {
    return view('admin.detail_news_login', compact('newsId'));
});

Route::get('/admin/approve_thesis', function () {
    return view('admin.approve_thesis');
});

Route::get('/admin/edit_and_detail_thesis/{thesisId}', function ($thesisId) {
    return view('admin.edit_and_detail_thesis', compact('thesisId'));
});

Route::get('/admin/menu_thesis_login', function () {
    return view('admin.menu_thesis_login');
});

Route::get('/admin/detail_thesis_login/{thesisId}', function ($thesisId) {
    return view('admin.detail_thesis_login', compact('thesisId'));
});

Route::get('/admin/manage_project', function () {
    return view('admin.manage_project');
});

Route::get('/admin/detail_project/{projectId}', function ($projectId) {
    return view('admin.detail_project', compact('projectId'));
});

Route::get('/admin/manage_exam_schedule', function () {
    return view('admin.manage_exam_schedule');
});

Route::get('/admin/manage_document_schedule', function () {
    return view('admin.manage_document_schedule');
});

Route::get('/admin/approve_documents', function () {
    return view('admin.approve_documents');
})->name('admin_approve_documents');

// branch-head Routes

Route::get('/branch-head', function () {
    return view('branch-head.dashboard');
})->name('brand-head');

Route::get('/branch-head/edit_branch_head', function () {
    return view('branch-head.edit_branch_head');
});

Route::get('/branch-head/manage_news', function () {
    return view('branch-head.manage_news');
});

Route::get('/branch-head/add_news', function () {
    return view('branch-head.add_news');
});

Route::get('/branch-head/edit_and_detail_news/{newsId}', function ($newsId) {
    return view('branch-head.edit_and_detail_news', compact('newsId'));
});

Route::get('/branch-head/menu_news_login', function () {
    return view('branch-head.menu_news_login');
});

Route::get('/branch-head/detail_news_login/{newsId}', function ($newsId) {
    return view('branch-head.detail_news_login', compact('newsId'));
});

Route::get('/branch-head/menu_thesis_login', function () {
    return view('branch-head.menu_thesis_login');
});

Route::get('/branch-head/detail_thesis_login/{thesisId}', function ($thesisId) {
    return view('branch-head.detail_thesis_login', compact('thesisId'));
});

Route::get('/branch-head/approve_documents_branch_head', function () {
    return view('branch-head.approve_documents_branch_head');
});

// Teacher Routes

Route::get('/teacher', function () {
    return view('teacher.dashboard');
})->name('teacher');

Route::get('/teacher/edit_teacher', function () {
    return view('teacher.edit_teacher');
});

Route::get('/teacher/edit_and_detail_teacher', function () {
    return view('teacher.edit_and_detail_teacher');
});

Route::get('/teacher/manage_news', function () {
    return view('teacher.manage_news');
});

Route::get('/teacher/add_news', function () {
    return view('teacher.add_news');
});

Route::get('/teacher/edit_and_detail_news/{newsId}', function ($newsId) {
    return view('teacher.edit_and_detail_news', compact('newsId'));
});

Route::get('/teacher/menu_news_login', function () {
    return view('teacher.menu_news_login');
});

Route::get('/teacher/detail_news_login/{newsId}', function ($newsId) {
    return view('teacher.detail_news_login', compact('newsId'));
});

Route::get('/teacher/menu_thesis_login', function () {
    return view('teacher.menu_thesis_login');
});

Route::get('/teacher/detail_thesis_login/{thesisId}', function ($thesisId) {
    return view('teacher.detail_thesis_login', compact('thesisId'));
});

Route::get('/teacher/approve_documents_teacher', function () {
    return view('teacher.approve_documents_teacher');
});

// Member Routes

Route::get('/member', function () {
    return view('member.dashboard');
})->name('member');

Route::get('/member/submit_project_documents', function () {
    return view('member.submit_project_documents');
});

Route::get('/member/edit_member', function () {
    return view('member.edit_member');
});

Route::get('/member/menu_news_login', function () {
    return view('member.menu_news_login');
});

Route::get('/member/detail_news_login/{newsId}', function ($newsId) {
    return view('member.detail_news_login', compact('newsId'));
});

Route::get('/member/menu_thesis_login', function () {
    return view('member.menu_thesis_login');
});

Route::get('/member/detail_thesis_login/{thesisId}', function ($thesisId) {
    return view('member.detail_thesis_login', compact('thesisId'));
});

Route::get('/member/manage_thesis', function () {
    return view('member.manage_thesis');
})->name('manage_thesis');

Route::get('/member/add_thesis', function () {
    return view('member.add_thesis');
});

Route::get('/member/edit_and_detail_thesis/{thesisId}', function ($thesisId) {
    return view('member.edit_and_detail_thesis', compact('thesisId'));
});

Route::get('/member/create_document/01', function () {
    return view('member.create_document');
})->name('create_document_01');

Route::get('/member/create_document/02', function () {
    return view('member.create_document_02');
})->name('create_document_02');

Route::get('/member/send-document', function () {
    return view('member.manage_submit_document');
})->name('submit_document');

Route::get('/member/manage-document', function () {
    return view('member.manage_document');
})->name('manage_document');
Route::get('/member/manage-document-01', function () {
    return view('member.manage_document_01');
});

Route::get('/pdf', [pdfGenerateController::class, 'generate'])->name('pdfGenerate');
//pdf
Route::prefix('pdf')->group(function () {
    Route::get('/01/{projectId}', [pdfGenerateController::class, 'pdf01Generate'])->name('pdf01Generate');
    Route::get('/02/{projectId}', [pdfGenerateController::class, 'pdf02Generate'])->name('pdf02Generate');
    Route::get('/03/{projectId}', [pdfGenerateController::class, 'pdf03Generate'])->name('pdf03Generate');
    Route::get('/04/{projectId}', [pdfGenerateController::class, 'pdf04Generate'])->name('pdf04Generate');
    Route::get('/05/{projectId}', [pdfGenerateController::class, 'pdf05Generate'])->name('pdf05Generate');
    Route::get('/06/{projectId}', [pdfGenerateController::class, 'pdf06Generate'])->name('pdf06Generate');
    Route::get('/07/{projectId}', [pdfGenerateController::class, 'pdf07Generate'])->name('pdf07Generate');
});

//test
Route::get('/test/{projectId}', function () {
    return view('/pdf/document');
})->name('test');
Route::get('/gen', [pdfGenerateController::class, 'generate']);
//Route::get('show', [AdminController::class, 'show']);

Route::get('Document/01/{id_project}', function ($id_project){
    return view('detail-document.detail_document_01',compact('id_project'));
})->name('detail_document_01');

Route::get('Document/02/{id_project}', function ($id_project){
    return view('detail-document.detail_document_02',compact('id_project'));
})->name('detail_document_02');
