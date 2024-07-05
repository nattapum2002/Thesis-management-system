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

Route::get('/thesis_detail/{thesisId}', function ($thesisId) {
    return view('thesis_detail', compact('thesisId'));
});

Route::get('/menu_news', function () {
    return view('menu_news');
});

Route::get('/news_detail/{newsId}', function ($newsId) {
    return view('news_detail', compact('newsId'));
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

//Admin

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

Route::get('/admin/approve_documents', function () {
    return view('admin.approve_documents');
});

// branch-head

Route::get('/branch-head', function () {
    return view('branch-head.dashboard');
})->name('brand-head');

Route::get('/branch-head/edit_branch_head', function () {
    return view('branch-head.edit_branch_head');
});

Route::get('/branch-head/manage_news_branch_head', function () {
    return view('branch-head.manage_news_branch_head');
});

Route::get('/branch-head/approve_documents_branch_head', function () {
    return view('branch-head.approve_documents_branch_head');
});

// teacher

Route::get('/teacher', function () {
    return view('teacher.dashboard');
})->name('teacher');

Route::get('/teacher/edit_teacher', function () {
    return view('teacher.edit_teacher');
});

Route::get('/teacher/edit_and_detail_teacher', function () {
    return view('teacher.edit_and_detail_teacher');
});

Route::get('/teacher/manage_news_teacher', function () {
    return view('teacher.manage_news_teacher');
});

Route::get('/teacher/approve_documents_teacher', function () {
    return view('teacher.approve_documents_teacher');
});

// member

Route::get('/member', function () {
    return view('member.dashboard');
})->name('member');

Route::get('/member/submit_project_documents', function () {
    return view('member.submit_project_documents');
});

Route::get('/member/edit_member', function () {
    return view('member.edit_member');
});

Route::get('/member/manage_thesis_member', function () {
    return view('member.manage_thesis_member');
});

Route::get('/member/create_document', function () {
    return view('member.create_document');
})->name('create_document_01');

Route::get('/member/send-document', function () {
    return view('member.manage_submit_document');
})->name('submit_document');

Route::get('/member/manage-document', function () {
    return view('member.manage_document');
})->name('manage_document');
//Route::get('show', [AdminController::class, 'show']);
Route::get('/member/manage-document-01', function () {
    return view('member.manage_document_01');
});
//Route::get('show', [AdminController::class, 'show']);
