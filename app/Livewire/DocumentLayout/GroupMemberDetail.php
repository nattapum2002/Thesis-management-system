<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;
use App\Models\Member;
use App\Models\Project;
use App\Models\level;
use App\Models\Course;
use App\Models\project_member;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\Adviser;
use Illuminate\Support\Facades\Auth;

class GroupMemberDetail extends Component
{
    //public $members;

    public function render()
    {
        // ดึงข้อมูลผู้ใช้ปัจจุบันที่ลงชื่อเข้าใช้งาน
        $currentUser = Auth::guard('members')->user();

        // หากไม่มีผู้ใช้ปัจจุบันที่ลงชื่อเข้าใช้งาน ไม่ต้องทำอะไรเพิ่มเติม
        if (!$currentUser) {
            return abort(403, 'Unauthorized');
        }

        // ดึงโปรเจกต์แรกที่ผู้ใช้ปัจจุบันเข้าร่วมพร้อมกับสมาชิกและที่ปรึกษาหลัก
        $project = $currentUser->projects
            ->with(['members.level', 'members.course', 'advisers' => function ($query) {
                $query->wherePivot('adviser_status', 'หลัก');
            }])->first();

        return view('livewire.group-member-detail', compact('project'));
    }
}