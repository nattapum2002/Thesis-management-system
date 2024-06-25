<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use app\Models\Member;

class GroupMemberDetail extends Component
{
    public function render()
    {
        // ดึงข้อมูลผู้ใช้ปัจจุบันที่ลงชื่อเข้าใช้งาน
        $currentUser = Auth::guard('members')->user();

        // หากไม่มีผู้ใช้ปัจจุบันที่ลงชื่อเข้าใช้งาน ไม่ต้องทำอะไรเพิ่มเติม
        if (!$currentUser) {
            return abort(403, 'Unauthorized');
        }

        // ดึงโปรเจกต์แรกที่ผู้ใช้ปัจจุบันเข้าร่วมพร้อมกับสมาชิกและที่ปรึกษาหลัก
        $project = $currentUser->projects()->with([
            'members' => function ($query) {
                $query->with(['level', 'course']);
            },
            'advisers' => function ($query) {
                $query->with('position');
            }
        ])->first();

        return view('livewire.document-layout.group-member-detail', ['project' => $project]);
    }
}
