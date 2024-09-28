<?php

namespace App\Livewire;

use App\Models\Confirm_student;
use App\Models\Document_submission_schedule;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MemberManageDocument extends Component
{
    
    use WithPagination;
    public $search;
    public function confirmDocument($document_id, $project_id)
    {
        Confirm_student::where('id_document', $document_id)
            ->where('id_student', Auth::guard('members')->user()->id_student)
            ->where('id_project', $project_id)
            ->update([
                'confirm_status' => true
            ]);
    }
    public function render()
    {
        $search = $this->search;
        $projects = Project::with([
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])
            ->whereHas('confirmStudents', function ($query) {
                $query->where('id_student', Auth::guard('members')->user()->id_student);
            })
            ->where(function($query) use ($search) {
                $query->where('project_name_th', 'like', '%' . $search . '%')
                      ->orWhere('project_name_en', 'like', '%' . $search . '%');
            })
            ->paginate(1);
        
        $document_time = Document_submission_schedule::where('status', true)->get();
        // dd($projects);
        return view('livewire.member-manage-document', ['projects' => $projects , 'document_time' => $document_time]);
    }
}