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
use App\Http\Controllers\LineController;
use App\Livewire\DocumentDetail\Document03;
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

Route::get('/Line/Login', [LineController::class, 'redirectToLineLogin'])->name('line.login');
Route::get('/Line/Callback', [LineController::class, 'handleLineCallback'])->name('line.callback');
Route::get('/Line/Send-Message/{userId}/{message}', [LineController::class, 'sendMessage'])->name('send.message');


//Welcome

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/menu_thesis', function () {
//     return view('menu_thesis');
// });

// Route::get('/detail_thesis/{thesisId}', function ($thesisId) {
//     return view('detail_thesis', compact('thesisId'));
// });

// Route::get('/menu_news', function () {
//     return view('menu_news');
// });

// Route::get('/detail_news/{newsId}', function ($newsId) {
//     return view('detail_news', compact('newsId'));
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Route::get('/login_member', function () {
//     return view('login_member');
// })->name('login_member');

// Route::get('/login_teacher', function () {
//     return view('login_teacher');
// })->name('login_teacher');

// Route::get('/logout', function () {
//     if (Auth::guard('members')->check()) {
//         Auth::guard('members')->logout();
//         session()->invalidate();
//         session()->regenerateToken();
//         return redirect('/login_member');
//     } else if (Auth::guard('teachers')->check()) {
//         Auth::guard('teachers')->logout();
//         session()->invalidate();
//         session()->regenerateToken();
//         return redirect('/login_teacher');
//     }
// })->name('logout');

//Welcome

Route::prefix('')->group(function () {
    Route::view('/', 'Welcome')->name('welcome');
    Route::view('/Thesis', 'menu_thesis')->name('welcome.thesis');
    Route::view('/Thesis/{thesisId}', 'detail_thesis')->name('welcome.thesis.detail');
    Route::view('/News', 'menu_news')->name('welcome.news');
    Route::view('/News/{newsId}', 'detail_news')->name('welcome.news.detail');
    Route::view('/Register', 'register')->name('register');
    Route::view('/Login/Member', 'login_member')->name('login.member');
    Route::view('/Login/Teacher', 'login_teacher')->name('login.teacher');
});

Route::get('/Logout', function () {
    if (Auth::guard('members')->check()) {
        Auth::guard('members')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('login.member'));
    } else if (Auth::guard('teachers')->check()) {
        Auth::guard('teachers')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('login.teacher'));
    }
})->name('logout');

//Admin Routes

Route::prefix('Admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');

    Route::view('/Manage-teacher', 'admin.manage_teacher')->name('admin.manage.teacher');
    Route::view('/Manage-teacher/Add', 'admin.add_teacher')->name('admin.add.teacher');
    Route::view('/Manage-teacher/Approve/{teacherId}', 'admin.approve_teacher')->name('admin.approve.teacher');
    Route::view('/Manage-teacher/Edit-account', 'admin.edit_admin')->name('admin.edit.admin');

    Route::view('/Manage-member', 'admin.manage_member')->name('admin.manage.member');
    Route::view('/Manage-member/Approve/{studentId}', 'admin.approve_member')->name('admin.approve.member');

    Route::view('/Manage-news', 'admin.manage_news')->name('admin.manage.news');
    Route::view('/Manage-news/Add', 'admin.add_news')->name('admin.add.news');
    Route::view('/Manage-news/Edit/{newsId}', 'admin.edit_and_detail_news')->name('admin.edit.detail.news');

    Route::view('/Approve-news', 'admin.approve_news')->name('admin.approve.news');
    Route::view('/Approve-news/{newsId}', 'admin.detail_approve_news')->name('admin.detail.approve.news');

    Route::view('/Menu-news', 'admin.menu_news_login')->name('admin.menu.news');
    Route::view('/Menu-news/{newsId}', 'admin.detail_news_login')->name('admin.detail.news');

    Route::view('/Menu-thesis', 'admin.menu_thesis_login')->name('admin.menu.thesis');
    Route::view('/Menu-thesis/{thesisId}', 'admin.detail_thesis_login')->name('admin.detail.thesis');

    Route::view('/Approve-thesis', 'admin.approve_thesis')->name('admin.approve.thesis');
    Route::view('/Approve-thesis/{thesisId}', 'admin.detail_approve_thesis')->name('admin.detail.approve.thesis');

    Route::view('/Manage-project', 'admin.manage_project')->name('admin.manage.project');
    Route::view('/Manage-project/{projectId}', 'admin.detail_project')->name('admin.detail.project');

    Route::view('/Exam-schedule', 'admin.manage_exam_schedule')->name('admin.manage.exam.schedule');

    Route::view('/Manage-document-schedule', 'admin.manage_document_schedule')->name('admin.manage.document.schedule');
    Route::view('/Manage-document-schedule/Add', 'admin.add_document_schedule')->name('admin.add.document.schedule');
    Route::view('/Manage-document-schedule/Edit/{scheduleId}', 'admin.edit_and_detail_document_schedule')->name('admin.edit.detail.document.schedule');

    Route::view('/Approve-document-schedule', 'admin.approve_documents')->name('admin.approve.documents');
});

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('admin');

// Route::get('/admin/manage_teacher', function () {
//     return view('admin.manage_teacher');
// })->name('manage_teacher');

// Route::get('/admin/add_teacher', function () {
//     return view('admin.add_teacher');
// });

// Route::get('/admin/approve_teacher/{teacherId}', function ($teacherId) {
//     return view('admin.approve_teacher', compact('teacherId'));
// });

// Route::get('/admin/manage_member', function () {
//     return view('admin.manage_member');
// })->name('manage_member');

// Route::get('/admin/approve_member/{studentId}', function ($studentId) {
//     return view('admin.approve_member', compact('studentId'));
// });

// Route::get('/admin/edit_admin', function () {
//     return view('admin.edit_admin');
// });

// Route::get('/admin/manage_news', function () {
//     return view('admin.manage_news');
// })->name('adminManageNews');

// Route::get('/admin/add_news', function () {
//     return view('admin.add_news');
// });

// Route::get('/admin/edit_and_detail_news/{newsId}', function ($newsId) {
//     return view('admin.edit_and_detail_news', compact('newsId'));
// });

// Route::get('/admin/approve_news', function () {
//     return view('admin.approve_news');
// });

// Route::get('/admin/detail_approve_news/{newsId}', function ($newsId) {
//     return view('admin.detail_approve_news', compact('newsId'));
// });

// Route::get('/admin/menu_news_login', function () {
//     return view('admin.menu_news_login');
// });

// Route::get('/admin/detail_news_login/{newsId}', function ($newsId) {
//     return view('admin.detail_news_login', compact('newsId'));
// });

// Route::get('/admin/menu_thesis_login', function () {
//     return view('admin.menu_thesis_login');
// });

// Route::get('/admin/detail_thesis_login/{thesisId}', function ($thesisId) {
//     return view('admin.detail_thesis_login', compact('thesisId'));
// });

// Route::get('/admin/approve_thesis', function () {
//     return view('admin.approve_thesis');
// });

// Route::get('/admin/detail_approve_thesis/{thesisId}', function ($thesisId) {
//     return view('admin.detail_approve_thesis', compact('thesisId'));
// });

// Route::get('/admin/manage_project', function () {
//     return view('admin.manage_project');
// });

// Route::get('/admin/detail_project/{projectId}', function ($projectId) {
//     return view('admin.detail_project', compact('projectId'));
// });

// Route::get('/admin/manage_exam_schedule', function () {
//     return view('admin.manage_exam_schedule');
// });

// Route::get('/admin/manage_document_schedule', function () {
//     return view('admin.manage_document_schedule');
// })->name('manage_document_schedule');

// Route::get('/admin/add_document_schedule', function () {
//     return view('admin.add_document_schedule');
// });

// Route::get('/admin/edit_and_detail_document_schedule/{scheduleId}', function ($scheduleId) {
//     return view('admin.edit_and_detail_document_schedule', compact('scheduleId'));
// });

// Route::get('/admin/approve_documents', function () {
//     return view('admin.approve_documents');
// })->name('admin_approve_documents');

// branch-head Routes

Route::prefix('Branch-head')->group(function () {
    Route::view('/', 'branch-head.dashboard')->name('branch-head.dashboard');

    Route::view('/Manage-project', 'branch-head.manage_project')->name('branch-head.manage.project');
    Route::view('/Manage-project/{projectId}', 'branch-head.detail_project')->name('branch-head.detail.project');

    Route::view('/Approve-documents', 'branch-head.approve_documents_branch_head')->name('branch-head.approve.documents');

    Route::view('/Exam-schedule', 'branch-head.manage_exam_schedule')->name('branch-head.manage.exam.schedule');

    Route::view('/Edit-account', 'branch-head.edit_branch_head')->name('branch-head.edit.branch-head');

    Route::view('/Manage-news', 'branch-head.manage_news')->name('branch-head.manage.news');
    Route::view('/Manage-news/Add', 'branch-head.add_news')->name('branch-head.add.news');
    Route::view('/Manage-news/Edit/{newsId}', 'branch-head.edit_and_detail_news')->name('branch-head.edit.detail.news');

    Route::view('/Menu-news', 'branch-head.menu_news_login')->name('branch-head.menu.news');
    Route::view('/Menu-news/{newsId}', 'branch-head.detail_news_login')->name('branch-head.detail.news');

    Route::view('/Menu-thesis', 'branch-head.menu_thesis_login')->name('branch-head.menu.thesis');
    Route::view('/Menu-thesis/{thesisId}', 'branch-head.detail_thesis_login')->name('branch-head.detail.thesis');
});

// Route::get('/branch-head', function () {
//     return view('branch-head.dashboard');
// })->name('brand-head');

// Route::get('/branch-head/manage_project', function () {
//     return view('branch-head.manage_project');
// });

// Route::get('/branch-head/detail_project/{projectId}', function ($projectId) {
//     return view('branch-head.detail_project', compact('projectId'));
// });

// Route::get('/branch-head/manage_exam_schedule', function () {
//     return view('branch-head.manage_exam_schedule');
// });

// Route::get('/branch-head/edit_branch_head', function () {
//     return view('branch-head.edit_branch_head');
// });

// Route::get('/branch-head/manage_news', function () {
//     return view('branch-head.manage_news');
// })->name('branchHeadManageNews');

// Route::get('/branch-head/add_news', function () {
//     return view('branch-head.add_news');
// });

// Route::get('/branch-head/edit_and_detail_news/{newsId}', function ($newsId) {
//     return view('branch-head.edit_and_detail_news', compact('newsId'));
// });

// Route::get('/branch-head/menu_news_login', function () {
//     return view('branch-head.menu_news_login');
// });

// Route::get('/branch-head/detail_news_login/{newsId}', function ($newsId) {
//     return view('branch-head.detail_news_login', compact('newsId'));
// });

// Route::get('/branch-head/menu_thesis_login', function () {
//     return view('branch-head.menu_thesis_login');
// });

// Route::get('/branch-head/detail_thesis_login/{thesisId}', function ($thesisId) {
//     return view('branch-head.detail_thesis_login', compact('thesisId'));
// });

// Route::get('/branch-head/approve_documents_branch_head', function () {
//     return view('branch-head.approve_documents_branch_head');
// });

// Teacher Routes

Route::prefix('Teacher')->group(function () {
    Route::view('/', 'teacher.dashboard')->name('teacher.dashboard');

    Route::view('/Manage-project', 'teacher.manage_project')->name('teacher.manage.project');
    Route::view('/Manage-project/{projectId}', 'teacher.detail_project')->name('teacher.detail.project');

    Route::view('/Exam-schedule', 'teacher.manage_exam_schedule')->name('teacher.manage.exam.schedule');

    Route::view('/Manage-news', 'teacher.manage_news')->name('teacher.manage.news');
    Route::view('/Manage-news/Add', 'teacher.add_news')->name('teacher.add.news');
    Route::view('/Manage-news/Edit/{newsId}', 'teacher.edit_and_detail_news')->name('teacher.edit.detail.news');

    Route::view('/Menu-news', 'teacher.menu_news_login')->name('teacher.menu.news');
    Route::view('/Menu-news/{newsId}', 'teacher.detail_news_login')->name('teacher.detail.news');

    Route::view('/Menu-thesis', 'teacher.menu_thesis_login')->name('teacher.menu.thesis');
    Route::view('/Menu-thesis/{thesisId}', 'teacher.detail_thesis_login')->name('teacher.detail.thesis');

    Route::view('/Approve-documents', 'teacher.approve_documents_teacher')->name('teacher.approve.documents.teacher');

    Route::view('/Edit-account', 'teacher.edit_teacher')->name('teacher.edit.teacher');
});

// Route::get('/teacher', function () {
//     return view('teacher.dashboard');
// })->name('teacher');

// Route::get('/teacher/manage_project', function () {
//     return view('teacher.manage_project');
// });

// Route::get('/teacher/detail_project/{projectId}', function ($projectId) {
//     return view('teacher.detail_project', compact('projectId'));
// });

// Route::get('/teacher/manage_exam_schedule', function () {
//     return view('teacher.manage_exam_schedule');
// });

// Route::get('/teacher/edit_teacher', function () {
//     return view('teacher.edit_teacher');
// });

// Route::get('/teacher/manage_news', function () {
//     return view('teacher.manage_news');
// })->name('teacherManageNews');

// Route::get('/teacher/add_news', function () {
//     return view('teacher.add_news');
// });

// Route::get('/teacher/edit_and_detail_news/{newsId}', function ($newsId) {
//     return view('teacher.edit_and_detail_news', compact('newsId'));
// });

// Route::get('/teacher/menu_news_login', function () {
//     return view('teacher.menu_news_login');
// });

// Route::get('/teacher/detail_news_login/{newsId}', function ($newsId) {
//     return view('teacher.detail_news_login', compact('newsId'));
// });

// Route::get('/teacher/menu_thesis_login', function () {
//     return view('teacher.menu_thesis_login');
// });

// Route::get('/teacher/detail_thesis_login/{thesisId}', function ($thesisId) {
//     return view('teacher.detail_thesis_login', compact('thesisId'));
// });

// Route::get('/teacher/approve_documents_teacher', function () {
//     return view('teacher.approve_documents_teacher');
// });

// Member Routes

Route::prefix('Member')->group(function () {
    Route::view('/', 'member.dashboard')->name('member.dashboard');

    Route::view('/Submit-project-documents', 'member.submit_project_documents')->name('member.submit.project.documents');

    Route::view('/Edit-account', 'member.edit_member')->name('member.edit.member');

    Route::view('/Manage-thesis', 'member.manage_thesis')->name('member.manage.thesis');
    Route::view('/Manage-thesis/Add', 'member.add_thesis')->name('member.add.thesis');
    Route::view('/Manage-thesis/Edit/{thesisId}', 'member.edit_and_detail_thesis')->name('member.edit.detail.thesis');

    Route::view('/Menu-thesis', 'member.menu_thesis_login')->name('member.menu.thesis');
    Route::view('/Menu-thesis/{thesisId}', 'member.detail_thesis_login')->name('member.detail.thesis');

    Route::view('/Menu-news', 'member.menu_news_login')->name('member.menu.news');
    Route::view('/Menu-news/{newsId}', 'member.detail_news_login')->name('member.detail.news');

    Route::view('/Manage-submit-document', 'member.manage_submit_document')->name('member.manage.submit.document');

    Route::view('/Manage-document', 'member.manage_document')->name('member.manage.document');

    Route::view('/Create-document/01', 'member.create_document')->name('member.create.document-01');
    Route::view('/Create-document/02', 'member.create_document_02')->name('member.create.document-02');
    Route::view('/Create-document/04', 'member.create_document_04')->name('member.create.document-04');
    Route::view('/Create-document/05', 'member.create_document_05')->name('member.create.document-05');
});

// Route::get('/member', function () {
//     return view('member.dashboard');
// })->name('member');

// Route::get('/member/submit_project_documents', function () {
//     return view('member.submit_project_documents');
// });

// Route::get('/member/edit_member', function () {
//     return view('member.edit_member');
// });

// Route::get('/member/menu_news_login', function () {
//     return view('member.menu_news_login');
// });

// Route::get('/member/detail_news_login/{newsId}', function ($newsId) {
//     return view('member.detail_news_login', compact('newsId'));
// });

// Route::get('/member/menu_thesis_login', function () {
//     return view('member.menu_thesis_login');
// });

// Route::get('/member/detail_thesis_login/{thesisId}', function ($thesisId) {
//     return view('member.detail_thesis_login', compact('thesisId'));
// });

// Route::get('/member/manage_thesis', function () {
//     return view('member.manage_thesis');
// })->name('manage_thesis');

// Route::get('/member/add_thesis', function () {
//     return view('member.add_thesis');
// });

// Route::get('/member/edit_and_detail_thesis/{thesisId}', function ($thesisId) {
//     return view('member.edit_and_detail_thesis', compact('thesisId'));
// });

// Route::get('/member/create_document/01', function () {
//     return view('member.create_document');
// })->name('create_document_01');

// Route::get('/member/create_document/02', function () {
//     return view('member.create_document_02');
// })->name('create_document_02');

// Route::get('/member/create_document/04', function () {
//     return view('member.create_document_04');
// })->name('create_document_04');

// Route::get('/member/create_document/05', function () {
//     return view('member.create_document_05');
// })->name('create_document_05');


// Route::get('/member/manage_submit_document', function () {
//     return view('member.manage_submit_document');
// })->name('submit_document');

// Route::get('/member/manage_document', function () {
//     return view('member.manage_document');
// })->name('manage_document');

// Route::get('/member/manage-document-01', function () {
//     return view('member.manage_document_01');
// });

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

    Route::get('/03-score/{projectId}', [pdfGenerateController::class, 'pdf03ScoreGenerate'])->name('pdf03ScoreGenerate');
});

//test
Route::get('/test/{projectId}', function () {
    return view('/pdf/document');
})->name('test');
Route::get('/gen', [pdfGenerateController::class, 'generate']);
//Route::get('show', [AdminController::class, 'show']);

Route::get('document/01/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_01', compact('id_project', 'id_document'));
})->name('detail_document_01');

// Route for Document Type 2
Route::get('document/02/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_02', compact('id_project', 'id_document'));
})->name('detail_document_02');

// Route for Document Type 3
Route::get('document/03/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_03', compact('id_project', 'id_document'));
})->name('detail_document_03');

// Route for Document Type 4
Route::get('document/04/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_04', compact('id_project', 'id_document'));
})->name('detail_document_04');

Route::get('document/05/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_05', compact('id_project', 'id_document'));
})->name('detail_document_05');

Route::get('document/06/{id_project}/{id_document}', function ($id_project, $id_document) {
    return view('detail-document.detail_document_06', compact('id_project', 'id_document'));
})->name('detail_document_06');




Route::get('/pdf-stream', [Document03::class, 'print'])->name('pdf.stream');