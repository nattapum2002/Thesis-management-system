<?php

namespace App\Livewire\Document;

use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Member;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateDocument02 extends Component
{
    public $selectProject, $members, $teachers, $project, $id_project = 'none';
    public function mount()
    {
        $this->selectProject = Project::with([
            'membersProject',
        ])
            ->whereHas('membersProject', function ($query) {
                $query->where('id_student', Auth::guard('members')->user()->id_student);
            })
            ->get();
    }
    public function create_document()
    {
        if ($this->id_project !== 'none') {
            DB::transaction(function () {
                $memberIds = collect($this->members->pluck('id_student'))
                    ->filter() // กรองค่าที่ไม่ใช่ null
                    ->map(function ($id_student) {
                        return Member::firstOrCreate(['id_student' => $id_student])->id_student;
                    })
                    ->toArray();

                $teacherIds = collect($this->teachers->pluck('id_teacher'))
                    ->filter() // กรองค่าที่ไม่ใช่ null
                    ->map(function ($id_teacher) {
                        return Teacher::firstOrCreate(['id_teacher' => $id_teacher])->id_teacher;
                    })
                    ->toArray();

                $admin_teacher = Teacher::where('user_type', 'Admin')->get();
                foreach ($admin_teacher as $admin_teacher_items) {
                    $admin_teachers = Confirm_teacher::create([
                        'id_teacher' => $admin_teacher_items->id_teacher,
                        'id_document' => 2,
                        'id_project' => $this->project->first()->id_project,
                        'id_position' => 3,
                        'confirm_status' => false,
                    ]);
                }

                $header_teacher = Teacher::where('user_type', 'Branch head')->first();
                $headTeacher = Confirm_teacher::create([
                    'id_teacher' => $header_teacher->id_teacher,
                    'id_document' => 2,
                    'id_project' => $this->project->first()->id_project,
                    'id_position' => 4,
                    'confirm_status' => false,
                ]);

                foreach ($memberIds as $member_Ids) {
                    $send_member = $member_Ids == Auth::guard('members')->user()->id_student ? true : false;
                    $student_document = Confirm_student::create([
                        'id_student' => $member_Ids,
                        'id_document' => 2,
                        'id_project' => $this->project->first()->id_project,
                        'confirm_status' => $send_member,
                    ]);
                }
                foreach ($teacherIds as $index => $teacherId) {
                    $position = $index == 0 ? 1 : 2; // กำหนด position โดยที่ปรึกษาหลักคือ index 0, ที่ปรึกษาร่วมคือ index อื่นๆ
                    Confirm_teacher::create([
                        'id_teacher' => $teacherId,
                        'id_document' => 2,
                        'id_project' => $this->project->first()->id_project,
                        'id_position' => $position,
                        'confirm_status' => false,
                    ]);
                }
            });
            return redirect()->route('manage_document');
        }else{
            session()->flash('message', 'กรุณาเลือกโครงการก่อนกดปุ่มสร้าง');
        }
       
    }
    function test()
    {
        dd($this->members->id_student);
    }
    public function render()
    {
        $this->project = collect(); // กำหนดค่าเริ่มต้นเป็นคอลเล็กชันว่างเปล่า
        if ($this->id_project !== 'none') {
            $this->project = Project::with([
                'members',
                'teachers',
            ])
                ->whereHas('members', function ($query) {
                    $query->where('id_project', 'like', '%' . $this->id_project . '%')
                        ->where('members.id_student', Auth::guard('members')->user()->id_student);
                })
                ->get();
            $this->members = $this->project->first()->members;
            $this->teachers = $this->project->first()->teachers;
        }
        return view('livewire.document.create-document02', ['project' => $this->project]);
    }
}
