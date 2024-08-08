<?php

namespace App\Livewire\Schedule;

use App\Models\Adviser;
use App\Models\Director;
use App\Models\Exam_schedule;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ManageExamSchedule extends Component
{
    use WithPagination;

    public $search = '';
    public $filterAdviser = 'ทั้งหมด';
    public $filterType = 'ทุกประเภท';
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
        $advisers = Adviser::with('project', 'teacher', 'position')
            ->when($this->filterAdviser != 'ทั้งหมด', function ($query) {
                $query->where('id_position', $this->filterAdviser)
                    ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
        $projectIds = $advisers->pluck('id_project')->unique()->toArray();
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
        $directors = Director::with('project', 'teacher', 'document')->get();
        $types = Exam_schedule::with('document')->select('id_document')->distinct()->get();
        return view('livewire.schedule.manage-exam-schedule', ['exam_schedules' => $exam_schedules, 'directors' => $directors, 'types' => $types]);
    }
}