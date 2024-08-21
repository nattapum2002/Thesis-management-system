<?php

namespace App\Livewire\Teacher;

use App\Models\Adviser;
use App\Models\Director;
use App\Models\Document_submission_schedule;
use App\Models\Exam_schedule;
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

        return view('livewire.teacher.dashboard', [
            'advisers' => $advisers,
            'directors' => $directors,
            'projects' => $projects,
            'examSchedules' => $examSchedules,
        ]);
    }
}
