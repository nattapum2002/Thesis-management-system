<?php

namespace App\Livewire\Document;

use App\Models\Adviser;
use App\Models\Comment;
use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Document;
use App\Models\Member;
use App\Models\Project;
use App\Models\Student_project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TeacherManageAllSubmitDocument extends Component
{
    public $not_approve_document, $not_approve_project, $id_teacher, $id_position, $another_comment, $members, $teachers, $project;
    public function teacher_document($id_document, $id_project)
    {

        $id_teacher = Auth::guard('teachers')->user()->id_teacher;

        // อัปเดตสถานะการยืนยันของอาจารย์ทุกคนที่มี id_teacher และ id_document เหมือนกันในโครงการเดียวกัน
        Confirm_teacher::where('id_document', $id_document)
            ->where('id_teacher', $id_teacher)
            ->where('id_project', $id_project)
            ->update([
                'confirm_status' => true
            ]);
        Adviser::where('id_teacher', $id_teacher)
            ->where('id_project', $id_project)
            ->update([
                'adviser_status' => 'active'
            ]);
    }
    public function not_approve($id_document, $id_project, $id_teacher, $id_position)
    {
        $this->dispatch('not_approve_comment');
        $this->not_approve_document = Document::find($id_document);
        $this->not_approve_project = Project::find($id_project);
        $this->id_teacher = $id_teacher;
        $this->id_position = $id_position;
    }
    public function not_approve_confirmed()
    {
        Comment::create([
            'id_document' => $this->not_approve_document->id_document,
            'id_project' => $this->not_approve_project->id_project,
            'comment' => $this->another_comment,
            'id_teacher' => $this->id_teacher,
            'id_position' => $this->id_position,
            'id_comment_list' => 2,
        ]);
        Confirm_teacher::where('id_document', $this->not_approve_document->id_document)
            ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
            ->where('id_project', $this->not_approve_project->id_project)
            ->update([
                'confirm_status' => false
            ]);
        return redirect()->route('admin.approve.documents');
    }

    public function create_document_07($id_project)
    {

        if ($id_project !== 'none') {
            DB::transaction(function () use ($id_project) {
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
                        'id_document' => 7,
                        'id_project' => $id_project,
                        'id_position' => 3,
                        'confirm_status' => false,
                    ]);
                }

                $header_teacher = Teacher::where('user_type', 'Branch head')->first();
                $headTeacher = Confirm_teacher::create([
                    'id_teacher' => $header_teacher->id_teacher,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 4,
                    'confirm_status' => false,
                ]);

                foreach ($memberIds as $member_Ids) {
                    $student_document = Confirm_student::create([
                        'id_student' => $member_Ids,
                        'id_document' => 7,
                        'id_project' => $id_project,
                        'confirm_status' => false,
                    ]);
                }
                $main_adviser = $this->project->first()->teachers->where('pivot.id_position', 1);
                Confirm_teacher::create([
                    'id_teacher' => $main_adviser->first()->id_teacher,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 1,
                    'confirm_status' => false,
                ]);

                $sub_adviser = $this->project->first()->teachers->where('pivot.id_position', 2);
                foreach ($sub_adviser as $sub_adviser_items) {
                    Confirm_teacher::create([
                        'id_teacher' => $sub_adviser_items->id_teacher,
                        'id_document' => 7,
                        'id_project' => $id_project,
                        'id_position' => 2,
                        'confirm_status' => false,
                    ]);
                }

                $main_director = Confirm_teacher::where('id_project', $this->project->first()->id_project)
                    ->where('id_document', 6)->where('id_position', 5)->get();
                Confirm_teacher::create([
                    'id_teacher' => $main_director->first()->id_teacher ?? 8,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 5,
                    'confirm_status' => false,
                ]);

                $sub_director = Confirm_teacher::where('id_project', $this->project->first()->id_project)
                    ->where('id_document', 6)->where('id_position', 6)->get();
                foreach ($sub_director as $sub_director_items) {
                    Confirm_teacher::create([
                        'id_teacher' => $sub_director_items->id_teacher,
                        'id_document' => 7,
                        'id_project' => $id_project,
                        'id_position' => 6,
                        'confirm_status' => false,
                    ]);
                }

                $sub_teacher = Confirm_teacher::where('id_project', $this->project->first()->id_project)
                    ->where('id_position', 7)
                    ->where('id_document', 6)->get();
                Confirm_teacher::create([
                    'id_teacher' => $sub_teacher->first()->id_teacher ?? 8,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 7,
                    'confirm_status' => false,
                ]);
            });
        }
    }
    public function document($id_document, $id_project)
    {
        switch ($id_document) {
            case 1:
                return redirect()->route('detail_document_01', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 2:
                return redirect()->route('detail_document_02', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 3:
                return redirect()->route('detail_document_03', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 4:
                return redirect()->route('detail_document_04', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 5:
                return redirect()->route('detail_document_05', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 6:
                return redirect()->route('detail_document_06', ['id_project' => $id_project, 'id_document' => $id_document]);
            case 7:
                return redirect()->route('detail_document_07', ['id_project' => $id_project, 'id_document' => $id_document]);
            default:
                // Redirect to a fallback route or handle the case where id_document is not recognized
                return dd(5555);
        }
    }
    public function mount()
    {
        $this->not_approve_document = new Document(); // กำหนดค่าเริ่มต้น
        $this->not_approve_project = new Project();  // กำหนดค่าเริ่มต้น
    }
    public function render()
    {
        $this->project = Project::with([
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document',
            'comments.project',
            'comments.teacher'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
            })
            ->get();

        $this->members = optional($this->project->first())->members;
        $this->teachers = optional($this->project->first())->teachers;

        //  dd($projects);
        return view('livewire.document.teacher-manage-all-submit-document', ['projects' => $this->project]);
    }
}
