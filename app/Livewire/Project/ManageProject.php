<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\Adviser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProject extends Component
{
    use WithPagination;

    public $search = '';
    public $filterAdviser = 'all';
    public $filterStatus = 'all';
    public $sortField = 'id_project';
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
        $advisers = Adviser::with(['project', 'teacher', 'position'])
            ->when($this->filterAdviser != 'all' && $this->filterAdviser != 'adviserAll', function ($query) {
                $query->where('id_position', $this->filterAdviser)
                    ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->when($this->filterAdviser == 'adviserAll', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
        $projectIds = $advisers->pluck('id_project')->unique()->toArray();
        $projects = Project::with([
            'members' => function ($query) {
                $query->with(['level', 'course']);
            },
            'advisers' => function ($query) {
                $query->with(['teacher', 'position']);
            }
        ])->whereIn('id_project', $projectIds)
            ->when($this->filterStatus != 'all', function ($query) {
                $query->where('project_status', $this->filterStatus);
            })
            ->when($this->search, function ($query) {
                $query->where('project_name_th', 'like', '%' . $this->search . '%')
                    ->orWhere('project_name_en', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);
        $status = Project::select('project_status')->distinct()->get();
        return view('livewire.project.manage-project', ['projects' => $projects, 'status' => $status]);
    }
}