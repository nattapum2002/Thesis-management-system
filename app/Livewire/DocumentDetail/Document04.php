<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use App\Models\Confirm_teacher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Document04 extends Component
{
    public $id_project, $id_document;
    public $admin_approve, $admin_approve_fix, $admin_comment_fix;
    public $branch_head_approve, $branch_head_approve_fix, $branch_head_comment_fix;
    public function Admin_approve()
    {
        DB::transaction(function () {
            if ($this->admin_approve == true) {
                Comment::create([
                    'comment' => 'เห็นชอบ',
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                        'confirm_status' => true
                    ]);
            }
            else if( $this->admin_approve_fix == true){
                Comment::create([
                    'comment' => 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม',
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);

                Comment::create([
                    'comment' => $this->admin_comment_fix,
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 2,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                        'confirm_status' => true
                    ]);
            }
        });
    }
    public function Brance_head_approve()
    {
        DB::transaction(function () {
            if ($this->branch_head_approve == true) {
                Comment::create([
                    'comment' => 'เห็นชอบ',
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 4,
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                        'confirm_status' => true
                    ]);
            }
            else if( $this->branch_head_approve_fix == true){
                Comment::create([
                    'comment' => 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม',
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 4,
                ]);

                Comment::create([
                    'comment' => $this->branch_head_comment_fix,
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 2,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 4,
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                        'confirm_status' => true
                    ]);
            }
        });
    }
    public function mount($id_project, $id_document)
    {
        $this->id_document = $id_document;
        $this->id_project = $id_project;
    }
    public function render()
    {
        return view('livewire.document-detail.document04');
    }
}
