<?php

namespace App\Livewire\Teacher;

use App\Models\Adviser;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Document_submission_schedule;
use App\Models\Exam_schedule;
use App\Models\News;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $advisers = Adviser::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $directors = Director::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $projectIds = $advisers->pluck('id_project')->unique()->toArray();
        $confirms = Confirm_teacher::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $news = News::with('teacher')
            ->whereHas('teacher', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
        $confirms = Confirm_teacher::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $projects = Project::with([
            'members' => function ($query) {
                $query->with(['level', 'course']);
            },
            'advisers' => function ($query) {
                $query->with(['teacher', 'position']);
            }
        ])->whereIn('id_project', $projectIds)
            ->orderBy('updated_at', 'asc')
            ->take(5)
            ->get();

        $examSchedules = Exam_schedule::with('project', 'teacher', 'document')
            ->where(function ($query) {
                $query->where('exam_day', '>', now())
                    ->orWhere(function ($query) {
                        $query->where('exam_day', now()->toDateString())
                            ->where('exam_time', '>', now()->toTimeString());
                    });
            })
            ->where('id_project', $projectIds)
            ->orderBy('exam_day', 'asc')
            ->orderBy('exam_time', 'asc')
            ->take(5)
            ->get();

        $chartColors = [
            "#4e73df",
            "#1cc88a",
            "#36b9cc",
            "#f6c23e",
            "#e74a3b",
            "#858796",
            "#FF0000",
            "#FFC0CB",
            "#800080",
            "#87CEEB",
            "#98FF98",
            "#808080",
            "#FFFFFF",
            "#000000",
            "#FFD700",
            "#FFA07A",
            "#F5F5DC",
            "#00FF00",
            "#00CED1",
            "#FFD700",
            "#4F4F4F",
            "#DC143C",
            "#FF69B4",
            "#006400",
            "#00008B",
            "#D8BFD8",
            "#FF8C00",
            "#FFFDD0",
            "#FFFF00",
            "#0000FF"
        ];
        $chartNewsLabels = $news->pluck('type')->unique()->values()->toArray();
        $chartNewsData = $news->groupBy('type')->map(function ($items) {
            return $items->count();
        })->values()->toArray();

        return view('livewire.teacher.dashboard', [
            'advisers' => $advisers,
            'directors' => $directors,
            'projects' => $projects,
            'confirms' => $confirms,
            'examSchedules' => $examSchedules,
            'chartColors' => $chartColors,
            'chartNewsLabels' => $chartNewsLabels,
            'chartNewsData' => $chartNewsData
        ]);
    }
}
