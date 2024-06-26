<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProject extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projects;
    public $search = '';

    public function mount()
    {
    }

    public function delete()
    {
        dd($this->project_name_th);
    }

    public function render()
    {
        $this->projects = Project::with([
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
            ->get();
        return view('livewire.admin-project', ['projects' => $this->projects]);
    }
}