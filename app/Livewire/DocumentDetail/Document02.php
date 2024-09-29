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

use function Laravel\Prompts\confirm;

class Document02 extends Component
{
    public $id_project, $id_document, $teachers, $students, $advisers;
    public $id_teacher = [];
    public $date, $time, $year, $term, $place, $building, $faculty;
    public $branch_head_approve, $branch_head_not_approve, $branch_head_comment;

    protected function rules()
    {
        $rules = [
            'date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'year' => 'required',
            'term' => 'required',
            'place' => 'required',
            'building' => 'required',
            'faculty' => 'required',
        ];

        if ($this->date <= now()->toDateString()) {
            $rules['time'] = 'required|date_format:H:i|after_or_equal:' . now()->toTimeString();
        } else {
            $rules['time'] = 'required|date_format:H:i';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'date.required' => 'กรุณาเลือกวันที่',
            'date.date' => 'รูปแบบวันที่ไม่ถูกต้อง',
            'date.after_or_equal' => 'ไม่สามารถกรอกวันที่ ที่ผ่านไปแล้วได้',

            'time.required' => 'กรุณาเลือกเวลา',
            'time.date_format' => 'รูปแบบเวลาไม่ถูกต้อง',
            'time.after_or_equal' => 'ไม่สามารถกรอกเวลา ที่ผ่านไปแล้วได้ ถ้ายังไม่ผ่านกรุณาตรวจสอบวันที่ก่อน',

            'year.required' => 'กรุณาเลือกปีการศึกษา',
            'term.required' => 'กรุณาเลือกภาคการศึกษา',

            'place.required' => 'กรุณากรอกสถานที่',

            'building.required' => 'กรุณาเลือกอาคาร',

            'faculty.required' => 'กรุณาเลือกคณะ',
        ];
    }

    public function confirmDocument_02()
    {
        $this->validate();
        DB::transaction(function () {
            $teacherIDs = collect($this->id_teacher)
                ->filter()
                ->map(function ($id_teacher) {
                    return Teacher::firstOrCreate(['id_teacher' => $id_teacher])->id_teacher;
                })->toArray();
            // dd($teacherIDs);
            $existingDirector = Director::where([
                'id_project' => $this->id_project,
                'id_document' => 3,
            ]); // ใช้ first() เพื่อดึงข้อมูลที่ตรงกัน

            $existingConfirmTeacher = Confirm_teacher::where([
                'id_project' => $this->id_project,
                'id_document' => 3,
            ]); // ใช้ first() เพื่อดึงข้อมูลที่ตรงกัน

            if ($existingDirector) {
                $existingDirector->delete();
            }
            if ($existingConfirmTeacher) {
                $existingConfirmTeacher->delete();
            }
            foreach ($teacherIDs as $index => $teacherID) {
                // กำหนดค่า position ตาม index
                if ($index == 0) {
                    $position = '5';
                } elseif (in_array($index, [1, 2])) {
                    $position = '6';
                } elseif ($index == 3) {
                    $position = '7';
                }
                Director::create([
                    'id_position' => $position,
                    'id_project' => $this->id_project,
                    'id_document' => 3,
                    'id_teacher' => $teacherID,
                ]);

                // สร้าง Confirm_teacher ใหม่
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
                Confirm_teacher::updateOrCreate(
                    [
                        'id_teacher' => $admin_teacher_items->id_teacher,
                        'id_document' => 3,
                        'id_project' => $this->id_project,
                        'id_position' => 3,
                    ],
                    [
                        'confirm_status' => false,
                    ]
                );
            }



            foreach ($this->students as $studentID) {
                Confirm_student::updateOrCreate(
                    [
                        'id_document' => 3,
                        'id_project' => $this->id_project,
                        'id_student' => $studentID,
                    ],
                    [
                        'confirm_status' => true,
                    ]
                );
            }

            $main_teacher = Adviser::where('id_project', $this->id_project)
                ->where('id_position', 1)
                ->first();

            if ($main_teacher) {
                Confirm_teacher::updateOrCreate(
                    [
                        'id_teacher' => $main_teacher->id_teacher,
                        'id_document' => 3,
                        'id_project' => $this->id_project,
                        'id_position' => 1,
                    ],
                    [
                        'confirm_status' => false,
                    ]
                );
            }
            Exam_schedule::updateOrCreate([
                'id_project' => $this->id_project,
                'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                'id_document' => 3,
            ], [
                'exam_day' => $this->date,
                'exam_time' => $this->time,
                'year_published' => $this->year,
                'exam_room' => $this->place,
                'exam_building' => $this->building,
                'exam_group' => $this->faculty,
                'semester' => $this->term,
            ]);

            Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                ->where('id_project', $this->id_project)
                ->where('id_document', 2)
                ->update(['confirm_status' => true]);
            return session()->flash('success', 'บันทึกวันสอบเสร็จสิ้น');
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
        DB::transaction(function () {
            if ($this->branch_head_approve || $this->branch_head_not_approve) {

                if ($this->branch_head_approve) {
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 2)
                        ->update(
                            [
                                'confirm_status' => true,
                            ]
                        );
                    Comment::updateOrCreate(
                        [
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_document' => 2,
                            'id_comment_list' => 1,
                            'id_position' => 4,
                        ],
                        [
                            'comment' => 'อนุมัติ',
                        ]
                    );
                } else if ($this->branch_head_not_approve) {
                    $validatedData = $this->validate([
                        'branch_head_comment' => 'required',
                    ]);
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 2)
                        ->update(
                            [
                                'confirm_status' => true,
                            ]
                        );
                    Comment::updateOrCreate(
                        [
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_document' => 2,
                            'id_comment_list' => 1,
                            'id_position' => 4,
                        ],
                        [
                            'comment' => 'ไม่อนุมัติ',
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_document' => 2,
                            'id_comment_list' => 2,
                            'id_position' => 4,
                        ],
                        [
                            'comment' => $this->branch_head_comment,
                        ]
                    );
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

                return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
            } else {
                session()->flash('error', 'กรุณาเลือกอนุมัติ หรือ ไม่อนุมัติ');
                return;
            }
        });
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
