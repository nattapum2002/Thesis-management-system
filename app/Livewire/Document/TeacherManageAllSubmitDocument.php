<?php

namespace App\Livewire\Document;

use App\Models\Adviser;
use App\Models\Comment;
use App\Models\Confirm_teacher;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherManageAllSubmitDocument extends Component
{
    public $not_approve_document, $not_approve_project, $id_teacher, $id_position, $another_comment;
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
        Adviser::where('id_teacher', $id_teacher)
        ->where('id_project', $id_project)
        ->update([
            'adviser_status' => 'active'
        ]);
    }
    public function not_approve($id_document, $id_project, $id_teacher, $id_position)
    {
        $this->dispatch('not_approve_comment');
        $this->not_approve_document = Document::find($id_document);
        $this->not_approve_project = Project::find($id_project);
        $this->id_teacher = $id_teacher;
        $this->id_position = $id_position;
    }
    public function not_approve_confirmed()
    {
        Comment::create([
            'id_document' => $this->not_approve_document->id_document,
            'id_project' => $this->not_approve_project->id_project,
            'comment' => $this->another_comment,
            'id_teacher' => $this->id_teacher,
            'id_position' => $this->id_position,
            'id_comment_list' => 2,
        ]);
        Confirm_teacher::where('id_document', $this->not_approve_document->id_document)
            ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
            ->where('id_project', $this->not_approve_project->id_project)
            ->update([
                'confirm_status' => false
            ]);
        return redirect()->route('admin_approve_documents');
    }
     public function document($id_document ,$id_project) {
        switch ($id_document) {
            case 1:
                return redirect()->route('detail_document_01',['id_project' => $id_project , 'id_document' => $id_document]);
            case 2:
                return redirect()->route('detail_document_02',['id_project' => $id_project , 'id_document' => $id_document]);
            case 3:
                return redirect()->route('detail_document_03',['id_project' => $id_project , 'id_document' => $id_document]);
            case 4:
                return redirect()->route('detail_document_04',['id_project' => $id_project , 'id_document' => $id_document]);
            case 5:
                return redirect()->route('detail_document_05',['id_project' => $id_project , 'id_document' => $id_document]);
            case 6:
                return redirect()->route('detail_document_06',['id_project' => $id_project , 'id_document' => $id_document]);

            default:
                // Redirect to a fallback route or handle the case where id_document is not recognized
                return dd(5555);
        }
     }
    public function mount()
    {
        $this->not_approve_document = new Document(); // กำหนดค่าเริ่มต้น
        $this->not_approve_project = new Project();  // กำหนดค่าเริ่มต้น
    }
    public function render()
    {
        $projects = Project::with([
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document',
            'comments.project',
            'comments.teacher'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();
            //  dd($projects);
        return view('livewire.document.teacher-manage-all-submit-document', ['projects' => $projects]);
    }
}
