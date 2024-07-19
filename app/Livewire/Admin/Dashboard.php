<?php

namespace App\Livewire\Admin;

use App\Models\Member;
use App\Models\Project;
use App\Models\Teacher;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $projects = Project::all();
        $members = Member::all();
        $teachers = Teacher::all();
        return view('livewire.admin.dashboard', [
            'projects' => $projects,
            'members' => $members,
            'teachers' => $teachers
        ]);
    }
}
