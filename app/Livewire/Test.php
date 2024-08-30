<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;
use App\Models\Teacher;

class Test extends Component
{
    public function render()
    {
        $members = Member::all();
        $teachers = Teacher::all();
        return view('livewire.test', compact('members', 'teachers'));
    }
}
