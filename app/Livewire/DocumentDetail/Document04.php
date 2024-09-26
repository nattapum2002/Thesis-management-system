<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Comment;
use App\Models\Confirm_teacher;
use App\Models\Project;
use App\Models\Teacher;
use App\Services\LineMessageService;
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
                Comment::updateOrCreate([
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ],[
                    'comment' => 'เห็นชอบ',
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                    'confirm_status' => true
                ]);
            } else if ($this->admin_approve_fix == true) {
                $this->validate([
                    'admin_comment_fix' => 'required',
                ],[
                    'admin_comment_fix.required' => 'กรุณากรอกความเห็น',
                ]);
                Comment::updateOrCreate([
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 1,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ],[
                    'comment' => 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม',
                ]);

                Comment::updateOrCreate([
                    'id_project' => $this->id_project,
                    'id_document' => $this->id_document,
                    'id_comment_list' => 2,
                    'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                    'id_position' => 3,
                ],[
                    'comment' => $this->admin_comment_fix,
                ]);

                Confirm_teacher::where(function ($query) {
                    $query->where('id_project', $this->id_project)
                        ->where('id_document', $this->id_document)
                        ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                })->update([
                    'confirm_status' => true
                ]);
            }
            return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
        });

        $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Branch head')->pluck('id_teacher')->toArray())
            ->where('id_project', $this->id_project)
            ->where('id_document', 4)
            ->where('confirm_status', true)
            ->exists();

        if ($confirmed) {
            $project = Project::with(['members', 'teachers', 'advisers'])
                ->where('id_project', $this->id_project)
                ->first();

            $message = 'เอกสาร คกท.-คง.-04 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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
    }
    public function Brance_head_approve()
    {
        if($this->branch_head_approve||$this->branch_head_approve_fix){
            DB::transaction(function () {
                if ($this->branch_head_approve == true) {
                    Comment::updateOrCreate([
                        'id_project' => $this->id_project,
                        'id_document' => $this->id_document,
                        'id_comment_list' => 1,
                        'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                        'id_position' => 4,
                    ],[
                        'comment' => 'เห็นชอบ',
                    ]);
    
                    Confirm_teacher::where(function ($query) {
                        $query->where('id_project', $this->id_project)
                            ->where('id_document', $this->id_document)
                            ->where('id_teacher', auth()->guard('teachers')->user()->id_teacher);
                    })->update([
                        'confirm_status' => true
                    ]);
                } else if ($this->branch_head_approve_fix == true) {
                    $validate = $this->validate([
                        'branch_head_comment_fix' => 'required|string',
                    ],[
                        'branch_head_comment_fix.required' => 'กรุณากรอกความเห็น',
                    ]);
                    Comment::updateOrCreate([
                        'id_project' => $this->id_project,
                        'id_document' => $this->id_document,
                        'id_comment_list' => 1,
                        'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                        'id_position' => 4,
                    ],[
                        'comment' => 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม',
                    ]);
    
                    Comment::updateOrCreate([
                        'id_project' => $this->id_project,
                        'id_document' => $this->id_document,
                        'id_comment_list' => 2,
                        'id_teacher' => auth()->guard('teachers')->user()->id_teacher,
                        'id_position' => 4,
                    ],[
                        'comment' => $this->branch_head_comment_fix,
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
    
            $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Admin')->pluck('id_teacher')->toArray())
                ->where('id_project', $this->id_project)
                ->where('id_document', 4)
                ->where('confirm_status', true)
                ->exists();
    
            if ($confirmed) {
                $project = Project::with(['members', 'teachers', 'advisers'])
                    ->where('id_project', $this->id_project)
                    ->first();
    
                $message = 'เอกสาร คกท.-คง.-04 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';
    
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
    
            return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
        }
        else{
            return session()->flash('error', 'กรุณาเลือกความเห็น');
        }
        
    
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