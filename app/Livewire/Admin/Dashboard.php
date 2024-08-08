<?php

namespace App\Livewire\Admin;

use App\Models\Adviser;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Dissertation_article;
use App\Models\Document_submission_schedule;
use App\Models\Exam_schedule;
use App\Models\Member;
use App\Models\News;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $projects = Project::with(['members', 'teachers', 'advisers'])->get();
        $members = Member::with(['level', 'course', 'projects'])->get();
        $teachers = Teacher::with(['news', 'projects'])->get();
        $thesis = Dissertation_article::with(['project'])->get();
        $news = News::with(['teacher'])->get();
        $advisers = Adviser::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $directors = Director::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $confirms = Confirm_teacher::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $documentSchedules = Document_submission_schedule::with('document')->get();
        $examSchedules = Exam_schedule::with('project', 'teacher', 'document')->get();

        $chartColors = [
            "#4e73df", "#1cc88a", "#36b9cc", "#f6c23e", "#e74a3b", "#858796",
            "#FF0000", "#FFC0CB", "#800080", "#87CEEB", "#98FF98", "#808080",
            "#FFFFFF", "#000000", "#FFD700", "#FFA07A", "#F5F5DC", "#00FF00",
            "#00CED1", "#FFD700", "#4F4F4F", "#DC143C", "#FF69B4", "#006400",
            "#00008B", "#D8BFD8", "#FF8C00", "#FFFDD0", "#FFFF00", "#0000FF"
        ];
        $chartNewsLabels = News::pluck('type')->unique()->values()->toArray();
        $chartNewsData = News::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count')
            ->toArray();
        // dd($chartNewsLabels);


        return view('livewire.admin.dashboard', [
            'projects' => $projects,
            'members' => $members,
            'teachers' => $teachers,
            'advisers' => $advisers,
            'directors' => $directors,
            'confirms' => $confirms,
            'thesis' => $thesis,
            'news' => $news,
            'documentSchedules' => $documentSchedules,
            'examSchedules' => $examSchedules,
            'chartColors' => $chartColors,
            'chartNewsLabels' => $chartNewsLabels,
            'chartNewsData' => $chartNewsData
        ]);
    }
}