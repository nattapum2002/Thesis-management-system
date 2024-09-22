<?php

// namespace App\Livewire\Member;

// use App\Models\Adviser;
// use App\Models\Confirm_student;
// use App\Models\Confirm_teacher;
// use App\Models\Director;
// use App\Models\Dissertation_article;
// use App\Models\Document_submission_schedule;
// use App\Models\Exam_schedule;
// use App\Models\Member;
// use App\Models\News;
// use App\Models\Project;
// use App\Models\Teacher;
// use App\Models\Student_project;
// use DateTime;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Livewire\Component;

// class Dashboard extends Component
// {
//     public function render()
//     {
//         $projects = Project::with(['members', 'teachers', 'advisers'])
//             ->whereIn(
//                 'id_project',
//                 Student_project::where(
//                     'id_student',
//                     Auth::guard('members')->user()->id_student
//                 )->pluck('id_project')
//             )->get();
//         $projectActive = $projects->where('project_status', '!=', 'reject')->first();

//         $confirmStudents = Confirm_student::with(['project', 'student', 'documents'])
//             ->where('id_project', $projectActive->id_project)
//             ->where('confirm_status', 1)->get();
//         $confirmTeachers = Confirm_teacher::with(['project', 'teacher', 'document'])
//             ->where('id_project', $projectActive->id_project)
//             ->where('confirm_status', 1)->get();
//         $teachers = Teacher::with(['news', 'projects'])->get();
//         $directors = Director::with(['project', 'document', 'teacher', 'position'])
//             ->where('id_project', $projectActive->id_project)->get();
//         $advisers = Adviser::with(['project', 'position', 'teacher'])
//             ->where('id_project', $projectActive->id_project)->get();
//         $examSchedules = Exam_schedule::with(['project', 'teacher', 'document'])
//             ->where('id_project', $projectActive->id_project)->orderBy('created_at', 'desc')->get();
//         $documentSchedules = Document_submission_schedule::with(['document'])->get();

//         $examCountDates = $examSchedules->where('exam_day', '>=', now())->Where('exam_time', '>', now())->first();

//         $members = Member::with(['level', 'course', 'projects'])->get();

//         $thesis = Dissertation_article::with(['project'])->get();
//         $news = News::with(['teacher'])->get();
//         return view('livewire.member.dashboard', [
//             'projects' => $projects,
//             'projectActive' => $projectActive,
//             'confirmStudents' => $confirmStudents,
//             'confirmTeachers' => $confirmTeachers,
//             'teachers' => $teachers,
//             'directors' => $directors,
//             'advisers' => $advisers,
//             'examSchedules' => $examSchedules,
//             'examCountDates' => $examCountDates,
//             'documentSchedules' => $documentSchedules,
//         ]);
//     }
// }

namespace App\Livewire\Member;

use App\Models\Adviser;
use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Dissertation_article;
use App\Models\Document_submission_schedule;
use App\Models\Exam_schedule;
use App\Models\Member;
use App\Models\News;
use App\Models\Project;
use App\Models\Teacher;
use App\Models\Student_project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Fetch the projects associated with the logged-in student
        $projects = Project::with(['members', 'teachers', 'advisers'])
            ->whereIn(
                'id_project',
                Student_project::where(
                    'id_student',
                    Auth::guard('members')->user()->id_student
                )->pluck('id_project')
            )->get();

        // Find the first active project (not rejected)
        $projectActive = $projects->where('project_status', '!=', 'reject')->first();

        // Check if there is an active project
        if (!$projectActive) {
            return view('livewire.member.dashboard', [
                'projects' => $projects,
                'projectActive' => null,
                'confirmStudents' => collect(),
                'confirmTeachers' => collect(),
                'teachers' => collect(),
                'directors' => collect(),
                'advisers' => collect(),
                'examSchedules' => collect(),
                'examCountDates' => null,
                'documentSchedules' => collect(),
            ]);
        }

        // Fetch related data only if there is an active project
        $confirmStudents = Confirm_student::with(['project', 'student', 'documents'])
            ->where('id_project', $projectActive->id_project)
            ->where('confirm_status', 1)->get();

        $confirmTeachers = Confirm_teacher::with(['project', 'teacher', 'document'])
            ->where('id_project', $projectActive->id_project)
            ->where('confirm_status', 1)->get();

        $teachers = Teacher::with(['news', 'projects'])->get();

        $directors = Director::with(['project', 'document', 'teacher', 'position'])
            ->where('id_project', $projectActive->id_project)->get();

        $advisers = Adviser::with(['project', 'position', 'teacher'])
            ->where('id_project', $projectActive->id_project)->get();

        $examSchedules = Exam_schedule::with(['project', 'teacher', 'document'])
            ->where('id_project', $projectActive->id_project)
            ->orderBy('created_at', 'desc')
            ->get();



        $examCountDates = $examSchedules->filter(function ($schedule) {
            return \Carbon\Carbon::parse($schedule->exam_day . ' ' . $schedule->exam_time) >= now();
        })->first();

        $documentSchedules = Document_submission_schedule::with(['document'])->get();

        return view('livewire.member.dashboard', [
            'projects' => $projects,
            'projectActive' => $projectActive,
            'confirmStudents' => $confirmStudents,
            'confirmTeachers' => $confirmTeachers,
            'teachers' => $teachers,
            'directors' => $directors,
            'advisers' => $advisers,
            'examSchedules' => $examSchedules,
            'examCountDates' => $examCountDates,
            'documentSchedules' => $documentSchedules,
        ]);
    }
}