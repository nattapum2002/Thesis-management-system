<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Confirm_teacher;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Services\LineMessageService;
use Illuminate\Support\Facades\DB;

class Document01 extends Component
{
    public $id_project, $id_document, $admin_comment;
    public $approve_project_name = [];
    public $approve_teacher = [];
    public $admin_not_approve = [];
    public $not_enough_Qualifications = [];
    public $out_of_student = [];
    public $admin_other_comment = false;
    public $branch_head_approve, $branch_head_not_approve, $branch_head_comment;

    public function mount($id_project, $id_document)
    {
        $this->id_project = $id_project;
        $this->id_document = $id_document;
    }
    public function approve()
    {
        if ($this->approve_project_name || $this->admin_not_approve) {
            $exitComment = Comment::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
            ->where('id_project', $this->id_project)
            ->where('id_document', 1);
            if ($exitComment) {
                $exitComment->delete();
            }
            
            // สร้างคอมเมนต์ใหม่หากมี approve_project_name
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
            
            // สร้างคอมเมนต์ใหม่หากมี approve_teacher
            if ($this->approve_teacher) {
                Comment::create([
                    'comment' => $this->approve_teacher[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }
            
            // อัปเดตสถานะ confirm_status เป็น true ถ้ามี approve_project_name หรือ approve_teacher
            if ($this->approve_project_name || $this->approve_teacher) {
                Confirm_teacher::updateOrCreate(
                    [
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                        'id_document' => 1
                    ],
                    [
                        'confirm_status' => true
                    ]
                );
            }
            
            if ($this->admin_not_approve) {
                Comment::create([
                    'comment' => $this->admin_not_approve[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);

                Confirm_teacher::updateOrCreate(
                    [
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                        'id_document' => 1
                    ],
                    [
                        'confirm_status' => false
                    ]
                );
            }

            if ($this->not_enough_Qualifications) {
                Comment::create([
                    'comment' => $this->not_enough_Qualifications[0],
                    'id_project' => $this->id_project,
                    'id_document' => 1,
                    'id_comment_list' => 1,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ]);
            }

            if ($this->out_of_student) {
                Comment::create([
                    'comment' => $this->out_of_student[0],
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

            $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Branch head')->pluck('id_teacher')->toArray())
                ->where('id_project', $this->id_project)
                ->where('id_document', 1)
                ->where('confirm_status', true)
                ->exists();

            if ($confirmed) {
                $project = Project::with(['members', 'teachers', 'advisers'])
                    ->where('id_project', $this->id_project)
                    ->first();

                $message = 'เอกสาร คกท.-คง.-01 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

                foreach ($project->members as $member) {
                    if (!empty($member->id_line)) { // ตรวจสอบว่ามีค่า id_line
                        $userId = $member->id_line;

                        // ตรวจสอบรูปแบบของ userId ถ้าจำเป็น (อาจใช้ regular expression หรือวิธีอื่น)
                        if (preg_match('/^U[a-fA-F0-9]{32}$/', $userId)) {
                            LineMessageService::sendMessage($userId, $message);
                        }
                    }
                }
            }
            return redirect()->route('admin.approve.documents');
        } else {
            return session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
        }
    }
    public function Brance_head_approve()
    {
        DB::transaction(function () {
            if ($this->branch_head_approve || $this->branch_head_not_approve) {
                $existingConfirm = Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 1)
                    ->first();
                $exitComment = Comment::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 1)
                    ->first();
                if ($this->branch_head_approve) {
                    if ($existingConfirm) {
                        // Update if exists
                        $existingConfirm->update([
                            'confirm_status' => true
                        ]);
                    } else {
                        // Create if not exists
                        Confirm_teacher::create([
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_document' => 1,
                            'confirm_status' => true
                        ]);
                    }
                    if ($exitComment) {
                        $exitComment->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                            ->where('id_project', $this->id_project)
                            ->where('id_document', 1)
                            ->where('id_comment_list', 1)->update([
                                'comment' => 'อนุมัติ',
                            ]);
                    } else {
                        Comment::create([
                            'comment' => 'อนุมัติ',
                            'id_project' => $this->id_project,
                            'id_document' => 1,
                            'id_comment_list' => 1,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_position' => 4,
                        ]);
                    }
                } else if ($this->branch_head_not_approve) {
                    if ($existingConfirm) {
                        // Update if exists
                        $existingConfirm->update([
                            'confirm_status' => false
                        ]);
                    } else {
                        // Create if not exists
                        Confirm_teacher::create([
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_document' => 1,
                            'confirm_status' => false
                        ]);
                    }


                    if ($exitComment) {
                        // Update the first comment if it exists
                        $exitComment->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                            ->where('id_project', $this->id_project)
                            ->where('id_document', 1)
                            ->where('id_comment_list', 1)
                            ->update([
                                'comment' => 'ไม่อนุมัติ',
                            ]);

                        // Check if a second comment with id_comment_list 2 exists
                        $secondComment = Comment::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                            ->where('id_project', $this->id_project)
                            ->where('id_document', 1)
                            ->where('id_comment_list', 2)
                            ->first();

                        if ($secondComment) {
                            // Update second comment if it exists
                            $secondComment->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                                ->where('id_project', $this->id_project)
                                ->where('id_document', 1)
                                ->where('id_comment_list', 2)
                                ->update([
                                    'comment' => $this->branch_head_comment,
                                ]);
                        } else {
                            // Create second comment if not exists
                            Comment::create([
                                'comment' => $this->branch_head_comment,
                                'id_project' => $this->id_project,
                                'id_document' => 1,
                                'id_comment_list' => 2,
                                'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                                'id_position' => 4,
                            ]);
                        }
                    } else {
                        // Create both comments if none exist
                        Comment::create([
                            'comment' => 'ไม่อนุมัติ',
                            'id_project' => $this->id_project,
                            'id_document' => 1,
                            'id_comment_list' => 1,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_position' => 4,
                        ]);

                        Comment::create([
                            'comment' => $this->branch_head_comment,
                            'id_project' => $this->id_project,
                            'id_document' => 1,
                            'id_comment_list' => 2,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_position' => 4,
                        ]);
                    }
                }

                $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Admin')->pluck('id_teacher')->toArray())
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 1)
                    ->where('confirm_status', true)
                    ->exists();

                if ($confirmed) {
                    $project = Project::with(['members', 'teachers', 'advisers'])
                        ->where('id_project', $this->id_project)
                        ->first();

                    $message = 'เอกสาร คกท.-คง.-01 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

                    foreach ($project->members as $member) {
                        if (!empty($member->id_line)) { // ตรวจสอบว่ามีค่า id_line
                            $userId = $member->id_line;

                            // ตรวจสอบรูปแบบของ userId ถ้าจำเป็น (อาจใช้ regular expression หรือวิธีอื่น)
                            if (preg_match('/^U[a-fA-F0-9]{32}$/', $userId)) {
                                LineMessageService::sendMessage($userId, $message);
                            }
                        }
                    }
                }
                return redirect()->route('branch-head.approve.documents');
            } else {
                return session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
            }
        });
    }

    public function render()
    {
        return view('livewire.document-detail.document01');
    }
}
