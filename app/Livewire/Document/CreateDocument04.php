<?php

namespace App\Livewire\Document;

use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Member;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateDocument04 extends Component
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

                // $teacherIds = collect($this->teachers->pluck('id_teacher'))
                //     ->filter() // กรองค่าที่ไม่ใช่ null
                //     ->map(function ($id_teacher) {
                //         return Teacher::firstOrCreate(['id_teacher' => $id_teacher])->id_teacher;
                //     })
                //     ->toArray();

                $admin_teacher = Teacher::where('user_type', 'Admin')->get();
                foreach ($admin_teacher as $admin_teacher_items) {
                    $admin_teachers = Confirm_teacher::create([
                        'id_teacher' => $admin_teacher_items->id_teacher,
                        'id_document' => 4,
                        'id_project' => $this->project->first()->id_project,
                        'id_position' => 3,
                        'confirm_status' => false,
                    ]);
                }

                $header_teacher = Teacher::where('user_type', 'Branch head')->first();
                $headTeacher = Confirm_teacher::create([
                    'id_teacher' => $header_teacher->id_teacher,
                    'id_document' => 4,
                    'id_project' => $this->project->first()->id_project,
                    'id_position' => 4,
                    'confirm_status' => false,
                ]);

                foreach ($memberIds as $member_Ids) {
                    $send_member = $member_Ids == Auth::guard('members')->user()->id_student ? true : false;
                    $student_document = Confirm_student::create([
                        'id_student' => $member_Ids,
                        'id_document' => 4,
                        'id_project' => $this->project->first()->id_project,
                        'confirm_status' => $send_member,
                    ]);
                }
                $main_adviser = $this->project->first()->teachers->where('pivot.id_position', 1);
                Confirm_teacher::create([
                    'id_teacher' => $main_adviser->first()->id_teacher,
                    'id_document' => 4,
                    'id_project' => $this->project->first()->id_project,
                    'id_position' => 1,
                    'confirm_status' => false,
                ]);

                $sub_adviser = $this->project->first()->teachers->where('pivot.id_position', 2);
                foreach ($sub_adviser as $sub_adviser_items) {
                    Confirm_teacher::create([
                        'id_teacher' => $sub_adviser_items->id_teacher,
                        'id_document' => 4,
                        'id_project' => $this->project->first()->id_project,
                        'id_position' => 2,
                        'confirm_status' => false,
                    ]);
                }

                $main_director = Confirm_teacher::where('id_project', $this->project->first()->id_project)->where('id_position', 5)->get();
                Confirm_teacher::create([
                    'id_teacher' => $main_director->first()->id_teacher ?? 8,
                    'id_document' => 4,
                    'id_project' => $this->project->first()->id_project,
                    'id_position' => 5,
                    'confirm_status' => false,
                ]);

                $sub_director = Confirm_teacher::where('id_project', $this->project->first()->id_project)->where('id_position', 6)->get();
                foreach ($sub_director as $sub_director_items) {
                    Confirm_teacher::create([
                        'id_teacher' => $sub_director_items->id_teacher,
                        'id_document' => 4,
                        'id_project' => $this->project->first()->id_project,
                        'id_position' => 6,
                        'confirm_status' => false,
                    ]);
                }

                $sub_teacher = Confirm_teacher::where('id_project', $this->project->first()->id_project)->where('id_position', 7)->get();
                Confirm_teacher::create([
                    'id_teacher' => $sub_teacher->first()->id_teacher ?? 8,
                    'id_document' => 4,
                    'id_project' => $this->project->first()->id_project,
                    'id_position' => 7,
                    'confirm_status' => false,
                ]);
                // dd($sub_teacher);
            });
            return redirect()->route('member.manage.document');
        } else {
            session()->flash('message', 'กรุณาเลือกโครงการก่อนกดปุ่มสร้าง');
        }
    }
    function test()
    {
        dd($this->project);
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
        return view('livewire.document.create-document04', ['project' => $this->project]);
    }
}
