<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class DetailProject extends Component
{
    public $project;
    public function mount($id)
    {
        $this->project = Project::with(
            'members',
            'members.level',
            'members.course',
            'advisers',
            'teachers'
        )->find($id);
    }

    public function render()
    {
        return view('livewire.project.detail-project');
    }
}
