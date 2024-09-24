<?php

namespace App\Livewire\Document;

use App\Models\Adviser;
use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Member;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class CreateDocument extends Component
{
    public $memberCount = 0;
    public $id_members = [];
    public $id_teacher = [];

    public $memberIds, $teacherIds;
    public $teachers;

    public $project_name_th, $project_name_eng, $project;
    protected $rules = [
        'id_members.*' => 'nullable|string|required', // validate array of integers
        'project_name_th' => 'required',
        'project_name_eng' => 'required',
        'id_teacher.0' => 'required',
    ];
    public function  getData()
    {
        $this->validate();
        $this->dispatch('openmodal');
    }
    public function mount()
    {
        // กำหนดค่าเริ่มต้นให้กับ id_members[0]
        $this->id_members[0] = Auth::guard('members')->user()->id_student;
        $this->id_teacher = [''];
        $this->project_name_th;
        $this->project_name_eng;
    }
    public function removeMember($index)
    {
        // Remove the specified member
        unset($this->id_members[$index]);

        // Reindex the array to ensure there are no gaps
        $this->id_members = array_values($this->id_members);

        // Adjust the memberCount accordingly
        $this->memberCount = count($this->id_members);
    }
    public function confirmDocument()
    {
        DB::transaction(function () {
            $memberIds = collect($this->id_members)
                ->filter() // กรองค่าที่ไม่ใช่ null
                ->map(function ($id_student) {
                    return Member::firstOrCreate(['id_student' => $id_student])->id_student;
                })
                ->toArray();

            // ตรวจสอบค่า id_teacher ก่อนกรองและแมพ

            $teacherIds = collect($this->id_teacher)
                ->filter() // กรองค่าที่ไม่ใช่ null
                ->map(function ($id_teacher) {
                    return Teacher::firstOrCreate(['id_teacher' => $id_teacher])->id_teacher;
                })
                ->toArray();

            $this->project = Project::create([
                'project_name_th' => $this->project_name_th,
                'project_name_en' => $this->project_name_eng,
                'project_status' => 'pending',
            ]);

            $admin_teacher = Teacher::where('user_type', 'Admin')->get();
            foreach ($admin_teacher as $admin_teacher_items) {
                $admin_teachers = Confirm_teacher::create([
                    'id_teacher' => $admin_teacher_items->id_teacher,
                    'id_document' => 1,
                    'id_project' => $this->project->id_project,
                    'id_position' => 3,
                    'confirm_status' => false,
                ]);
            }

            $header_teacher = Teacher::where('user_type', 'Branch head')->first();
            $headTeacher = Confirm_teacher::create([
                'id_teacher' => $header_teacher->id_teacher,
                'id_document' => 1,
                'id_project' => $this->project->id_project,
                'id_position' => 4,
                'confirm_status' => false,
            ]);

            foreach ($memberIds as $member_Ids) {
                $send_member = $member_Ids == Auth::guard('members')->user()->id_student ? true : false;
                $student_document = Confirm_student::create([
                    'id_student' => $member_Ids,
                    'id_document' => 1,
                    'id_project' => $this->project->id_project,
                    'confirm_status' => $send_member,
                ]);
            }
            foreach ($teacherIds as $index => $teacherId) {
                $position = $index == 0 ? 1 : 2; // กำหนด position โดยที่ปรึกษาหลักคือ index 0, ที่ปรึกษาร่วมคือ index อื่นๆ
                Confirm_teacher::create([
                    'id_teacher' => $teacherId,
                    'id_document' => 1,
                    'id_project' => $this->project->id_project,
                    'id_position' => $position,
                    'confirm_status' => false,
                ]);
            }
            $advisers = collect($teacherIds)->mapWithKeys(function ($id_teacher, $index) {
                $position = $index == 0 ? 1 : 2; // ที่ปรึกษาหลักคือ index 0 ที่ปรึกษาร่วมคือ index อื่นๆ
                $adviser = Adviser::firstOrCreate(
                    ['id_teacher' => $id_teacher, 'id_position' => $position],
                    ['adviser_status' => 'not_active', 'id_project' => $this->project->id_project]
                );
                return [$adviser->id_teacher => ['id_position' => $position, 'adviser_status' => 'not_active', 'id_project' => $this->project->id_project]];
            });

            $this->project->members()->sync($memberIds);
            $this->project->teachers()->sync($advisers);
        });

        // session()->flash('message', 'Document created successfully!');

        return redirect()->route('member.manage.document');
    }

    public function confirmTeacherDocument()
    {
        $mainTeacher = Teacher::where('id_teacher', $this->id_teacher[0])->get();
        // ดึงข้อมูลที่ปรึกษาร่วม
        $subTeacherIds = array_slice($this->id_teacher, 1);
        $subTeachers = Teacher::whereIn('id_teacher', $subTeacherIds)->get();

        return [
            'main_teachers' => $mainTeacher,
            'sub_teachers' => $subTeachers,
        ];
    }

    public function confirmMember()
    {
        return Member::whereIn('id_student', $this->id_members)->get();
    }

    public function render()
    {
        $this->teachers = Teacher::all();
        $confirm_teacher = $this->confirmTeacherDocument();

        return view('livewire.document.create-document', [
            'mainTeacher' => $confirm_teacher['main_teachers'],
            'sub_teachers' => $confirm_teacher['sub_teachers'],
            'members' => $this->confirmMember(),
        ]);
    }
}
