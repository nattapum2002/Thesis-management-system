<?php

namespace App\Livewire\Document;

use App\Models\Confirm_teacher;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherManageAllSubmitDocument extends Component
{
    public $not_approve_document , $not_approve_project,$id_teacher,$id_position , $another_comment;
    public function teacher_document($id_document, $id_project)
    {
        $id_teacher = Auth::guard('teachers')->user()->id_teacher;

        // อัปเดตสถานะการยืนยันของอาจารย์ทุกคนที่มี id_teacher และ id_document เหมือนกันในโครงการเดียวกัน
        Confirm_teacher::where('id_document', $id_document)
            ->where('id_teacher', $id_teacher)
            ->where('id_project', $id_project)
            ->update([
                'confirm_status' => true
            ]);
    }
    public function not_approve($id_document,$id_project,$id_teacher,$id_position){
        $this->dispatch('not_approve_comment');
        $this->not_approve_document = Document::find($id_document);
        $this->not_approve_project = Project::find($id_project);
        $this->id_teacher = $id_teacher;
        $this->id_position = $id_position;
    }
    public function not_approve_confirmed(){
        dd($this->not_approve_document->id_document,$this->not_approve_project->id_project,$this->another_comment,$this->id_teacher,$this->id_position);
    }

    public function mount(){
        $this->not_approve_document = new Document(); // กำหนดค่าเริ่มต้น
        $this->not_approve_project = new Project();  // กำหนดค่าเริ่มต้น
    }
    public function render()
    {
        $projects = Project::with([
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
        return view('livewire.document.teacher-manage-all-submit-document', ['projects' => $projects]);
    }
}
