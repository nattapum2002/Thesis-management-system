<?php

namespace App\Livewire\Document;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherManageAllSubmitDocument extends Component
{
    public function render()
    {
        $projects = Project::with([
            'confirmStudents.student', 
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])
        ->whereHas('confirmTeachers', function($query) {
            $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
        })
        ->get();
        return view('livewire.document.teacher-manage-all-submit-document',['projects' => $projects]);
    }
}
