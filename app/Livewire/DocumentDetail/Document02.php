<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Adviser;
use App\Models\Comment;
use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Exam_schedule;
use App\Models\Project;
use App\Models\Student_project;
use App\Models\Teacher;
use App\Services\LineMessageService;
use Directory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Document02 extends Component
{
    public $id_project, $id_document, $teachers, $students, $advisers;
    public $id_teacher = [];
    public $date, $time, $year, $term, $place, $building, $faculty;
    public $branch_head_approve, $branch_head_not_approve, $branch_head_comment;
    public function confirmDocument_02()
    {
        DB::transaction(function () {
            $teacherIDs = collect($this->id_teacher)
                ->filter()
                ->map(function ($id_teacher) {
                    return Teacher::firstOrCreate(['id_teacher' => $id_teacher])->id_teacher;
                })->toArray();

            foreach ($teacherIDs as $index => $teacherID) {
                if ($index == 0) {
                    $position = '5';
                } elseif (in_array($index, [1, 2])) {
                    $position = '6';
                } elseif ($index == 3) {
                    $position = '7';
                }
                Director::create([
                    'id_teacher' => $teacherID,
                    'id_project' => $this->id_project,
                    'id_document' => 3,
                    'id_position' => $position,
                ]);
                Confirm_teacher::create([
                    'id_project' => $this->id_project,
                    'id_document' => 3,
                    'id_teacher' => $teacherID,
                    'id_position' => $position,
                    'confirm_status' => false,
                ]);
            }

            $admin_teacher = Teacher::where('user_type', 'Admin')->get();
            foreach ($admin_teacher as $admin_teacher_items) {
                $admin_teachers = Confirm_teacher::create([
                    'id_teacher' => $admin_teacher_items->id_teacher,
                    'id_document' => 3,
                    'id_project' => $this->id_project,
                    'id_position' => 3,
                    'confirm_status' => false,
                ]);
            }

            $header_teacher = Teacher::where('user_type', 'Branch head')->first();
            $headTeacher = Confirm_teacher::create([
                'id_teacher' => $header_teacher->id_teacher,
                'id_document' => 3,
                'id_project' => $this->id_project,
                'id_position' => 4,
                'confirm_status' => false,
            ]);
            foreach ($this->students as $studentID) {
                $student = Confirm_student::create([
                    'id_student' => $studentID,
                    'id_document' => 3,
                    'id_project' => $this->id_project,
                    'confirm_status' => true,
                ]);
            }
            $main_teacher = Adviser::all()->where('id_project', $this->id_project)->where('id_position', 1)->where('id_project', $this->id_project);
            Confirm_teacher::create([
                'id_teacher' => $main_teacher->first()->id_teacher,
                'id_document' => 3,
                'id_project' => $this->id_project,
                'id_position' => 1,
                'confirm_status' => false,
            ]);
            Exam_schedule::create([
                'exam_day' => $this->date,
                'exam_time' => $this->time,
                'year_published' => $this->year,
                'exam_room' => $this->place,
                'exam_building' => $this->building,
                'exam_group' => $this->faculty,
                'semester' => $this->term,
                'id_project' => $this->id_project,
                'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                'id_document' => 3,
            ]);
        });

        $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Branch head')->pluck('id_teacher')->toArray())
            ->where('id_project', $this->id_project)
            ->where('id_document', 2)
            ->where('confirm_status', true)
            ->exists();

        if ($confirmed) {
            $project = Project::with(['members', 'teachers', 'advisers'])
                ->where('id_project', $this->id_project)
                ->first();

            $message = 'เอกสาร คกท.-คง.-02 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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
        if ($this->branch_head_approve || $this->branch_head_not_approve) {
            if ($this->branch_head_approve) {
                Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 2)
                    ->update([
                        'confirm_status' => true
                    ]);
            } else if ($this->branch_head_not_approve) {
                Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 2)
                    ->update([
                        'confirm_status' => false
                    ]);
                if ($this->branch_head_comment) {
                    Comment::create([
                        'comment' => $this->branch_head_comment,
                        'id_project' => $this->id_project,
                        'id_document' => 2,
                        'id_comment_list' => 2,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_position' => 4,
                    ]);
                }
            }

            $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Admin')->pluck('id_teacher')->toArray())
                ->where('id_project', $this->id_project)
                ->where('id_document', 2)
                ->where('confirm_status', true)
                ->exists();

            if ($confirmed) {
                $project = Project::with(['members', 'teachers', 'advisers'])
                    ->where('id_project', $this->id_project)
                    ->first();

                $message = 'เอกสาร คกท.-คง.-02 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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

            return redirect()->route('branch-head.approve.documents');
        } else {
            session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
            return;
        }
    }
    public function mount($id_project, $id_document)
    {
        $this->id_document = $id_document;
        $this->id_project = $id_project;
        $this->students = Student_project::where('id_project', $this->id_project)->pluck('id_student');
    }
    public function render()
    {
        $this->teachers = Teacher::all();
        return view('livewire.document-detail.document02');
    }
}