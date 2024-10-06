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
    public $filterAdviser;
    public $filterStatus = 'all';
    public $sortField = 'id_project';
    public $sortDirection = 'asc';

    public function mount()
    {
        $user = Auth::guard('teachers')->user();
        $this->filterAdviser = $user->user_type == 'Admin' ? 'all' : 'adviserAll';
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field)
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortField = $field;
    }

    public function render()
    {
        $user = Auth::guard('teachers')->user();
        $adviserQuery = Adviser::with(['project', 'teacher', 'position'])
            ->when($this->filterAdviser != 'all' && $this->filterAdviser != 'adviserAll', function ($query) use ($user) {
                $query->where('id_position', $this->filterAdviser)
                    ->where('id_teacher', $user->id_teacher);
            })
            ->when($this->filterAdviser == 'adviserAll', function ($query) use ($user) {
                $query->where('id_teacher', $user->id_teacher);
            });

        if ($user->user_type != 'Admin') {
            $adviserQuery->where('id_teacher', $user->id_teacher);
        }

        $projectIds = $adviserQuery->get()->pluck('id_project')->unique();

        $projects = Project::with([
            'members.level',
            'members.course',
            'advisers.teacher',
            'advisers.position',
        ])->whereIn('id_project', $projectIds)
            ->when($this->filterStatus != 'all', function ($query) {
                $query->where('project_status', $this->filterStatus);
            })
            ->when($this->search, function ($query) {
                $query->where('project_name_th', 'like', '%' . $this->search . '%')
                    ->orWhere('project_name_en', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);

        $status = Project::where('project_status', '!=', 'import')->select('project_status')->distinct()->get();

        return view('livewire.project.manage-project', [
            'projects' => $projects,
            'status' => $status
        ]);
    }
}
