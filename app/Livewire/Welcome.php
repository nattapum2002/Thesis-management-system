<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Project;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $projects = Project::all();
        $members = Member::all();
        return view('livewire.welcome', [
            'projects' => $projects,
            'members' => $members
        ]);
    }
}
