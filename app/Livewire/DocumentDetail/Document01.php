<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Confirm_teacher;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Document01 extends Component
{
    public $id_project,$id_document , $admin_comment;
    public $approve_project_name = [];
    public $approve_teacher = [];
    public $admin_not_approve = [];
    public $not_enough_Qualifications = [];
    public $out_of_student = [];
    public $admin_other_comment = false;
    public $branch_head_approve , $branch_head_not_approve , $branch_head_comment ;
    public function mount($id_project,$id_document){
        $this->id_project = $id_project;
        $this->id_document = $id_document;
    }
    public function approve(){
        if($this->approve_project_name ||$this->admin_not_approve ){
            if ($this->approve_project_name) {
                Comment::create([
                    'comment' => $this->approve_project_name[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
    
            if ($this->approve_teacher) {
                    Comment::create(['comment' => $this->approve_teacher[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }

            if($this->approve_project_name||$this->approve_teacher){
                Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                ->where('id_project', $this->id_project)
                ->where('id_document', 1)
                ->update([
                    'confirm_status' => true
                ]);
            }
    
            if ($this->admin_not_approve) {
                Comment::create(['comment' => $this->admin_not_approve[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
    
            if ($this->not_enough_Qualifications) {
                Comment::create(['comment' => $this->not_enough_Qualifications[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
    
            if ($this->out_of_student) {
                Comment::create(['comment' => $this->out_of_student[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
    
            if ($this->admin_other_comment) {
                Comment::create([
                    'comment' => $this->admin_comment,
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 2,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
        }else{
            return session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
        }
        
    }
    public function Brance_head_approve(){
        if($this->branch_head_approve || $this->branch_head_not_approve ){
            if ($this->branch_head_approve) {
                Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                ->where('id_project', $this->id_project)
                ->where('id_document', 1)
                ->update([
                    'confirm_status' => true
                ]);

                return redirect()->route('admin_approve_documents');
            }
            else if($this->branch_head_not_approve){
                Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                ->where('id_project', $this->id_project)
                ->where('id_document', 1)
                ->update([
                    'confirm_status' => false
                ]);

                Comment::create([
                    'comment' => $this->branch_head_comment,
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 2,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 4,
                ]);

                return redirect()->route('admin_approve_documents');
            }
        }else{
            return session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
        }
    }
    
    public function render()
    {
        return view('livewire.document-detail.document01');
    }
}
