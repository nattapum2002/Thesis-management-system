<?php

namespace App\Livewire;

use Livewire\Component;

class AdminProject extends Component
{
    public $id_project, $project_name_th, $project_name_eng, $project_status;
    public $id_student, $prefix, $name, $surname, $student_image;
    public $id_level, $level, $sector;
    public $id_course, $course, $branch;

    public function delete()
    {
        dd($this->project_name_th);
    }

    public function render()
    {
        return view('livewire.admin-project');
    }
}