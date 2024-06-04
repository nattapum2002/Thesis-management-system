<?php

namespace App\Livewire;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageTeacher extends Component
{
    public function render()
    {
        return view('livewire.manage-teacher');
    }
    public function add()
    {
        return dd(555555);
    }
}
