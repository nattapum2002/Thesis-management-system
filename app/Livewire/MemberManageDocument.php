<?php

namespace App\Livewire;

use App\Models\Confirm_student;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberManageDocument extends Component
{

    public function render()
    {
        
        $projects = Project::with([
            'confirmStudents.student', 
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])
        ->whereHas('confirmStudents', function($query) {
            $query->where('id_student', Auth::guard('members')->user()->id_student);
        })
        ->get();
        // dd($projects);
        return view('livewire.member-manage-document',['projects' => $projects]);
    }
}
