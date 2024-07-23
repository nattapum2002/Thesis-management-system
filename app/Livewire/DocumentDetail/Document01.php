<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Confirm_teacher;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Document01 extends Component
{
    public $id_project , $comment;
    public $approve_project_name = [];
    public $approve_teacher = [];
    public $not_approve = [];
    public $not_enough_Qualifications = [];
    public $out_of_student = [];
    public $other_comment = false;
    public function mount($id_project){
        $this->id_project = $id_project;
    }
    public function approve(){
        if($this->approve_project_name ||$this->not_approve ){
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
    
            if ($this->not_approve) {
                Comment::create(['comment' => $this->not_approve[0],
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
    
            if ($this->other_comment) {
                Comment::create(['comment' => $this->other_comment,
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 2,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
        }else{
            session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
            return;
        }
        
    }
    public function render()
    {

        $projects = Project::with([
            'confirmStudents'=> function($query) {
                $query->where('id_document', 1)->with('student');
            },
            'confirmTeachers'=> function($query) {
                $query->where('id_document', 1)->with('teacher');
            },
            'comments.project',
            'comments.teacher'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_document', 1)
                    ->where('id_project', $this->id_project);
            })
            ->get();
            // $groupedConfirmed = $projects->map(function ($project) {
            //     return $project->confirmTeachers->groupBy('id_document');
            // });
            // dd($groupedConfirmed);
        return view('livewire.document-detail.document01',['projects' => $projects]);
    }
}
