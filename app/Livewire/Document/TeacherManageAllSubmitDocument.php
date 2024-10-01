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
use App\Services\LineMessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherManageAllSubmitDocument extends Component
{
    use WithPagination;

    public $not_approve_document, $not_approve_project, $id_teacher, $id_position, $another_comment, $members, $teachers, $project, $search;
    public $filterType = 'all';
    public function teacher_document($id_document, $id_project)
    {
        $adviserConfirm = false;
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

        if ($id_document == 1 || $id_document == 2 || $id_document == 5) {
            $teacherIds = Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [3, 4])
                ->where('id_teacher', '!=', Auth::guard('teachers')->user()->id_teacher)
                ->pluck('id_teacher');

            $allConfirmed = !Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [1, 2])
                ->where('confirm_status', 0)
                ->exists();

            $message = 'อาจารย์ที่ปรึกษาได้พิจารณาเอกสาร คกท.-คง.-0' . $id_document . ' แล้ว กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';
        } elseif ($id_document == 3 || $id_document == 6) {
            $teacherIds = Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [3, 4])
                ->where('id_teacher', '!=', Auth::guard('teachers')->user()->id_teacher)
                ->pluck('id_teacher');

            $allConfirmed = !Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [5, 6, 7])
                ->where('confirm_status', 0)
                ->exists();

            $message = 'กรรมการได้พิจารณาเอกสาร คกท.-คง.-0' . $id_document . ' แล้ว กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';
        } elseif ($id_document == 4 || $id_document == 7) {
            $teacherIds = Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [5, 6])
                ->where('id_teacher', '!=', Auth::guard('teachers')->user()->id_teacher)
                ->pluck('id_teacher');

            $allConfirmed = !Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [1, 2])
                ->where('confirm_status', 0)
                ->exists();

            $message = 'อาจารย์ที่ปรึกษาได้พิจารณาเอกสาร คกท.-คง.-0' . $id_document . ' แล้ว กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

            $adviserConfirm = true;
        } elseif (($id_document == 4 || $id_document == 7) && $adviserConfirm) {
            $teacherIds = Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [3, 4])
                ->where('id_teacher', '!=', Auth::guard('teachers')->user()->id_teacher)
                ->pluck('id_teacher');

            $allConfirmed = !Confirm_teacher::where('id_document', $id_document)
                ->where('id_project', $id_project)
                ->whereIn('id_position', [5, 6, 7])
                ->where('confirm_status', 0)
                ->exists();

            $message = 'กรรมการได้พิจารณาเอกสาร คกท.-คง.-0' . $id_document . ' แล้ว กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

            $adviserConfirm = false;
        }

        $teachers = Teacher::whereIn('id_teacher', $teacherIds)->get();

        if ($allConfirmed) {
            foreach ($teachers as $teacher) {
                if (!empty($teacher->id_line)) { // ตรวจสอบว่ามีค่า id_line
                    $userId = $teacher->id_line;

                    // ตรวจสอบรูปแบบของ userId ถ้าจำเป็น (อาจใช้ regular expression หรือวิธีอื่น)
                    if (preg_match('/^U[a-fA-F0-9]{32}$/', $userId)) {
                        LineMessageService::sendMessage($userId, $message);
                    }
                }
            }
        }
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
                $memberIds = Student_project::where('id_project', $id_project)
                    ->pluck('id_student') // ดึงเฉพาะคอลัมน์ id_student
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
                $main_adviser = Adviser::where('id_project', $id_project)->where('id_position', 1)->get();
                Confirm_teacher::create([
                    'id_teacher' => $main_adviser->first()->id_teacher,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 1,
                    'confirm_status' => false,
                ]);

                // $sub_adviser = Adviser::where('id_project', $id_project)->where('id_position', 2)->get();
                // foreach ($sub_adviser as $sub_adviser_items) {
                //     Confirm_teacher::create([
                //         'id_teacher' => $sub_adviser_items->id_teacher,
                //         'id_document' => 7,
                //         'id_project' => $id_project,
                //         'id_position' => 2,
                //         'confirm_status' => false,
                //     ]);
                // }

                $main_director = Confirm_teacher::where('id_project', $id_project)
                    ->where('id_document', 6)->where('id_position', 5)->get();
                Confirm_teacher::create([
                    'id_teacher' => $main_director->first()->id_teacher ?? 8,
                    'id_document' => 7,
                    'id_project' => $id_project,
                    'id_position' => 5,
                    'confirm_status' => false,
                ]);
                $sub_director = Confirm_teacher::where('id_project', $id_project)
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

                $sub_teacher = Confirm_teacher::where('id_project', $id_project)
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

            $project = Project::with(['members', 'teachers', 'advisers'])
                ->where('id_project', $this->id_project)
                ->first();

            $message = 'สร้างเอกสาร คกท.-คง.-07 เรียบร้อย กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

            foreach ($project->members as $member) {
                if (!empty($member->id_line)) { // ตรวจสอบว่ามีค่า id_line
                    $userId = $member->id_line;

                    // ตรวจสอบรูปแบบของ userId ถ้าจำเป็น (อาจใช้ regular expression หรือวิธีอื่น)
                    if (preg_match('/^U[a-fA-F0-9]{32}$/', $userId)) {
                        LineMessageService::sendMessage($userId, $message);
                    }
                }
            }

            session()->flash('success', 'สร้างเอกสารเรียบร้อย');
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
    public function find()
    {
        $this->resetPage();
    }
    public function render()
    {
        // Make sure to apply the active tab for your pagination query
        $projects = Project::with([
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
            ->where(function ($query) {
                $query->where('project_name_th', 'like', '%' . $this->search . '%')
                    ->orWhere('project_name_en', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->whereHas('confirmTeachers', function ($q) {
                    $q->where('confirm_status', $this->filterType)
                        ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher);
                });
            })
            ->orderByRaw("(
            SELECT CASE WHEN confirm_status = false THEN 0 ELSE 1 END
            FROM confirm_teachers
            WHERE confirm_teachers.id_project = projects.id_project
            LIMIT 1
        )")
            ->get();

        // Fetching members and teachers for the first project
        $this->members = optional($projects->first())->members;
        $this->teachers = optional($projects->first())->teachers;

        return view('livewire.document.teacher-manage-all-submit-document', ['projects' => $projects]);
    }
}
