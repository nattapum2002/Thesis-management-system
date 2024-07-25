<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProject extends Component
{
    use WithPagination;

    public $search = '';

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
            })
            ->paginate(5);
        return view('livewire.project.manage-project', ['projects' => $projects]);
    }
}
