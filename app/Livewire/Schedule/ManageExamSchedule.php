<?php

namespace App\Livewire\Schedule;

use App\Models\Director;
use App\Models\Exam_schedule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ManageExamSchedule extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDirector;
    public $filterType = 'ทุกประเภท';
    public $sortField = 'id_exam_schedule';
    public $sortDirection = 'asc';

    public function mount()
    {
        $user = Auth::guard('teachers')->user();
        $this->filterDirector = $user->user_type == 'Admin' ? 'ทั้งหมด' : 'กรรมการ';
    }

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
        $director = Director::with('project', 'teacher', 'document')
            ->when($this->filterDirector != 'ทั้งหมด' && $this->filterDirector != 'กรรมการ', function ($query) {
                $query->where('id_position', $this->filterDirector)
                    ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->when($this->filterDirector == 'กรรมการ', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
        $projectIds = $director->pluck('id_project')->unique()->toArray();
        $exam_schedules = Exam_schedule::with('project', 'teacher', 'document')
            ->whereIn('id_project', $projectIds)
            ->when($this->filterType != 'ทุกประเภท', function ($query) {
                $query->where('id_document', $this->filterType);
            })
            ->when($this->search, function ($query) {
                $query->Where('exam_group', 'like', '%' . $this->search . '%')
                    ->orWhere('exam_building', 'like', '%' . $this->search . '%')
                    ->orWhere('exam_room', 'like', '%' . $this->search . '%')
                    ->orWhere('exam_day', 'like', '%' . $this->search . '%')
                    ->orWhere('exam_time', 'like', '%' . $this->search . '%')
                    ->orWhere('year_published', 'like', '%' . $this->search . '%')
                    ->orWhere('semester', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $types = Exam_schedule::with('document')->select('id_document')->distinct()->get();
        return view('livewire.schedule.manage-exam-schedule', ['exam_schedules' => $exam_schedules, 'directors' => $directors, 'types' => $types]);
    }
}
