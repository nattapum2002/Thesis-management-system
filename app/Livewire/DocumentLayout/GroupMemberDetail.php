<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class GroupMemberDetail extends Component
{
    public function render()
    {
        // ดึงโปรเจกต์แรกที่ผู้ใช้ปัจจุบันเข้าร่วมพร้อมกับสมาชิกและที่ปรึกษาหลัก
        $projects = Project::whereHas('members' , function($query){
            $query->where('student_projects.id_student',Auth::guard('members')->user()->id_student)
            ->join('courses','courses.id_course','=','members.id_course');
        }
        )->with('members','teachers','advisers')
        ->get();
        
        // dd($projects);
        return view('livewire.document-layout.group-member-detail', ['projects' => $projects]);
    }
}
