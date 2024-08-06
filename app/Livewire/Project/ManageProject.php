<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProject extends Component
{
    use WithPagination;

    public $search = '';
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
        $projects = Project::with([
            'members' => function ($query) {
                $query->with(['level', 'course']);
            },
            'advisers' => function ($query) {
                $query->with(['teacher', 'position']);
            }
        ])
            ->when($this->search, function ($query) {
                $query->where('project_name_th', 'like', '%' . $this->search . '%')
                    ->orWhere('project_name_en', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);
        return view('livewire.project.manage-project', ['projects' => $projects]);
    }
}