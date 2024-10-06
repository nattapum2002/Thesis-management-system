<?php

namespace App\Livewire\Schedule;

use App\Models\Director;
use App\Models\Exam_schedule;
use App\Models\Student_project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ManageExamSchedule extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDirector = 'กรรมการ';
    public $filterType = 'all';
    public $sortField = 'id_exam_schedule';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $directors = Director::with('project', 'teacher', 'document')->get();

        // Handle project IDs based on the user type
        if (Auth::guard('teachers')->check()) {
            $director = Director::with('project', 'teacher', 'document')
                ->when($this->filterDirector != 'all' && $this->filterDirector != 'กรรมการ', function ($query) {
                    $query->where('id_position', $this->filterDirector)
                        ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
                })
                ->when($this->filterDirector == 'กรรมการ', function ($query) {
                    $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
                })
                ->get();

            $projectIds = $director->pluck('id_project')->unique()->toArray();
        } else {
            // Fetch projects for students
            $projectIds = Student_project::where('id_student', Auth::guard('members')->user()->id_student)
                ->pluck('id_project')
                ->unique()
                ->toArray();
        }

        // Fetch exam schedules based on the project IDs
        $exam_schedules = Exam_schedule::with('project', 'teacher', 'document')
            ->whereIn('id_project', $projectIds)
            ->when($this->filterType != 'all', function ($query) {
                $query->where('id_document', $this->filterType);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('exam_group', 'like', '%' . $this->search . '%')
                        ->orWhere('exam_building', 'like', '%' . $this->search . '%')
                        ->orWhere('exam_room', 'like', '%' . $this->search . '%')
                        ->orWhere('exam_day', 'like', '%' . $this->search . '%')
                        ->orWhere('exam_time', 'like', '%' . $this->search . '%')
                        ->orWhere('year_published', 'like', '%' . $this->search . '%')
                        ->orWhere('semester', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        // Fetch distinct types (documents) for filtering
        $types = Exam_schedule::with('document')
            ->select('id_document')
            ->distinct()
            ->get();

        return view('livewire.schedule.manage-exam-schedule', [
            'exam_schedules' => $exam_schedules,
            'directors' => $directors,
            'types' => $types
        ]);
    }
}
