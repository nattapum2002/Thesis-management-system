<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;
use App\Models\Comment; // ต้องให้การ์ให้เหมาะสมกับโมเดล Comment ของคุณ
use Illuminate\Support\Facades\Auth; // เพิ่มให้ใช้งาน Auth

class Doc01CommentAdminInput extends Component
{
    public $comment;
    public $approvalTopic;
    public $advisorApproval;
    public $rejectReason;

    public $id_project;
    public $id_document = 1; // ใส่ค่า id_document เป็น 1 สำหรับกรณีนี้
    public $id_comment_list;
    public $id_teacher; // คุณต้องกำหนด id_teacher เป็น ID ของอาจารย์ที่ปรึกษาปัจจุบัน
    public $id_position = 3; // ใส่ค่า id_position เป็น 3 สำหรับกรณีนี้

    public function render()
    {
        return view('livewire.document-layout.doc01-comment-admin-input');
    }

    public function submitForm()
    {
        // ตรวจสอบให้แน่ใจว่าผู้ใช้ล็อกอินแล้ว
        if (!Auth::check()) {
            // ทำอะไรบางอย่างถ้าผู้ใช้ยังไม่ได้ล็อกอิน
            return;
        }

        // ตรรกะที่ใช้ในการกำหนด id_comment_list จากประเภทข้อมูลที่ผู้ใช้เลือก
        if ($this->approvalTopic == 'topic-approval') {
            $this->id_comment_list = 1; // ตัวอย่างสำหรับประเภท checkbox
        } elseif ($this->advisorApproval == 'approve') {
            $this->id_comment_list = 1; // ตัวอย่างสำหรับประเภท radio
        } elseif ($this->advisorApproval == 'reject') {
            $this->id_comment_list = 2; // ตัวอย่างสำหรับประเภท radio
        }

        // กำหนดค่า id_teacher เป็น ID ของผู้ใช้ที่ล็อกอินอยู่
        $this->id_teacher = Auth::id();

        // บันทึกความคิดเห็นลงในฐานข้อมูล
        Comment::create([
            'comment' => $this->comment,
            'id_project' => $this->id_project,
            'id_document' => $this->id_document,
            'id_comment_list' => $this->id_comment_list,
            'id_teacher' => $this->id_teacher,
            'id_position' => $this->id_position,
        ]);
        // รีเซ็ตฟิลด์ฟอร์มหลังจากการส่ง
        $this->reset();
    }
}
