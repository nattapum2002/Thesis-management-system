<?php

namespace App\Livewire;

use App\Models\Confirm_student;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberManageDocument extends Component
{

    public function confirmDocument($document_id, $project_id){
        Confirm_student::where('id_document', $document_id)
        ->where('id_student', Auth::guard('members')->user()->id_student)
        ->where('id_project', $project_id)
        ->update([
            'confirm_status' => true 
        ]);
    }
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
