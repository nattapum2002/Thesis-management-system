<?php

namespace App\Livewire\Schedule;

use App\Models\Director;
use App\Models\Exam_schedule;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class ManageExamSchedule extends Component
{
    use WithPagination;

    public $search = '';
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
        $exam_schedules = Exam_schedule::with('project', 'teacher', 'document')
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
        $directors = Director::with('project', 'teacher', 'document')->get();
        return view('livewire.schedule.manage-exam-schedule', ['exam_schedules' => $exam_schedules, 'directors' => $directors]);
    }
}