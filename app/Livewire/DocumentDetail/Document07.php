<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use App\Models\Confirm_teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Document07 extends Component
{
    public $id_project, $id_document;
    public $branch_head_approve, $branch_head_approve_fix, $branch_head_approve_fix_comment;
    public $admin_approve, $admin_approve_fix, $admin_approve_fix_comment;

    public function admin_comment()
    {
        DB::transaction(function () {
            if ($this->admin_approve || $this->admin_approve_fix) {
                if ($this->admin_approve) {
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 3
                        ],
                        [
                            'comment' => 'อนุมัติ'
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 7)
                        ->update(['confirm_status' => true]);
                } elseif ($this->admin_approve_fix) {
                    $this->validate([
                       'admin_approve_fix_comment' => 'required',
                    ],[
                        'admin_approve_fix_comment.required' => 'กรุณากรอกความเห็น',
                    ]);
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 3
                        ],
                        [
                            'comment' => 'ให้แก้ไขอีกครั้ง'
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 3
                        ],
                        [
                            'comment' => $this->admin_approve_fix_comment
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 7)
                        ->update(['confirm_status' => true]);
                }
            }
            return session()->flash('comment success', 'บันทึกความเห็นเสร็จสิ้น');
        });
    }

    public function branch_head_comment()
    {
        DB::transaction(function () {
            if ($this->branch_head_approve || $this->branch_head_approve_fix) {
                if ($this->branch_head_approve) {
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 4
                        ],
                        [
                            'comment' => 'อนุมัติ'
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 7)
                        ->update(['confirm_status' => true]);
                } elseif ($this->branch_head_approve_fix) {
                    $validateComment = $this->validate([
                        'branch_head_approve_fix_comment' => 'required',
                    ],[
                        'branch_head_approve_fix_comment.required' => 'กรุณากรอกความเห็น',]);
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 4
                        ],
                        [
                            'comment' => 'ให้แก้ไขอีกครั้ง'
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 4
                        ],
                        [
                            'comment' => $this->branch_head_approve_fix_comment
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 7)
                        ->update(['confirm_status' => true]);
                }
                return session()->flash('comment success', 'บันทึกความเห็นเสร็จสิ้น');
            }else{
            return session()->flash('comment error', 'กรุณากรอกความเห็น');}
           
        });
    }
    public function mount($id_project, $id_document)
    {
        $this->id_project = $id_project;
        $this->id_document = $id_document;
    }
    public function render()
    {
        return view('livewire.document-detail.document07');
    }
}