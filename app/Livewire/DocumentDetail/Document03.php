<?php

namespace App\Livewire\DocumentDetail;


use App\Models\Adviser;
use App\Models\Comment;
use App\Models\Confirm_teacher;
use App\Models\Project;
use App\Models\Score;
use App\Models\Student_project;
use App\Models\Teacher;
use App\Services\LineMessageService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Document03 extends Component
{
    public $id_project, $teachers, $students, $advisers, $id_document, $project, $approve, $approve_fix, $not_approve, $approve_fix_comment, $not_approve_comment;
    public $score_student = [];
    public $_sumScore = 0;
    public $branch_head_approve_fix, $branch_head_approve;

    public $criterias = [
        ['name' => '1. บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง', 'score' => 10],
        ['name' => '2. การนำเสนอผลงาน', 'score' => ''],
        ['name' => '2.1 ไฟล์นำเสนอมีความสมบูรณ์', 'score' => 10],
        ['name' => '2.2 สัดส่วนของเนื้อหาที่นำเสนอ<br>(ควรเน้นผลการทดลองและการอภิปรายผล)', 'score' => 10],
        ['name' => '3. การตอบคำถาม ความรู้ ความเข้าใจในโครงงาน', 'score' => 20],
        ['name' => '4. ความสมบูรณ์ของเอกสารโครงงานฉบับร่าง', 'score' => ''],
        ['name' => '4.1 รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน', 'score' => 10],
        ['name' => '4.2 เนื้อหาครบถ้วน', 'score' => 10],
        ['name' => '5. ความสำเร็จของโครงงานตาม', 'score' => ''],
        ['name' => '5.1 วัตถุประสงค์ของโครงงาน', 'score' => 10],
        ['name' => '5.2 ขอบเขตของโครงงาน', 'score' => 10],
        ['name' => '6. ความพร้อมและตรงต่อเวลา', 'score' => 10],
    ];

    public function print()
    {
        $pdf = PDF::loadView('Livewire_pdf.document_03_score');
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream('test.pdf');
        // }, 'test.pdf');
        // return response()->make($pdf->stream('test.pdf'), 200, [
        //     'Content-Type' => 'application/pdf',
        // ]);
        return $pdf->stream('test.pdf');
    }
    public function score_calculate()
    {
        DB::transaction(function () {
            $transformedData = array_map(function ($key, $value) {
                $filteredScores = array_filter($value, function ($score) {
                    return !is_null($score); // Keep only non-null values
                });

                return [
                    'student_id' => $key,
                    'scores' => $filteredScores
                ];
            }, array_keys($this->score_student), $this->score_student);
            // dd($transformedData);
            $skip_value = 22; // ค่า ID ที่ต้องการข้าม
            foreach ($transformedData as $index => $value) {
                // Reset comment list ID สำหรับนักเรียนแต่ละคน
                $current_comment_list_id = 20;

                foreach ($value['scores'] as $scoreIndex => $score) {
                    // ตรวจสอบว่าต้องข้ามค่า ID หรือไม่
                    if ($current_comment_list_id == $skip_value) {
                        $current_comment_list_id++; // ข้ามค่า ID ที่กำหนด
                    }

                    // บันทึกข้อมูลคะแนน
                    Score::updateOrCreate(
                        [
                            'id_student' => $value['student_id'],
                            'id_document' => $this->id_document,
                            'id_comment_list' => $current_comment_list_id,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        ],
                        [
                            'score' => $score,
                            'id_position' => 3
                        ]
                    );

                    // เพิ่มค่า ID ของ comment list
                    $current_comment_list_id++;
                }
            }
            return session()->flash('score success', 'กรอกคะแนนเสร็จสิ้น');
        });

        $teacherIds = Confirm_teacher::where('id_document', $this->id_document)
            ->where('id_project', $this->id_project)
            ->whereIn('id_position', [5, 6, 7])
            ->where('id_teacher', '!=', Auth::guard('teachers')->user()->id_teacher)
            ->pluck('id_teacher');

        $teachers = Teacher::whereIn('id_teacher', $teacherIds)->get();

        $message = 'อาจารย์ประจำวิชาได้สรุปคะแนนของสอบหัวข้อแล้ว กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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

    public function test_progress()
    {
        DB::transaction(function () {
            if ($this->approve || $this->approve_fix || $this->not_approve) {
                if ($this->approve) {
                    $header_teacher = Teacher::where('user_type', 'Branch head')->first();

                    Confirm_teacher::updateOrCreate(
                        [
                            'id_teacher' => $header_teacher->id_teacher,
                            'id_document' => 3,
                            'id_project' => $this->id_project,
                            'id_position' => 4,
                        ],
                        [
                            'confirm_status' => false,
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 3
                        ],
                        [
                            'comment' => 'ผ่าน'
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 3)
                        ->update(['confirm_status' => true]);
                } else if ($this->approve_fix) {
                    $this->validate([
                        'approve_fix_comment' => 'required'
                    ], [
                        'approve_fix_comment.required' => 'กรุณากรอกข้อความ'
                    ]);
                    $header_teacher = Teacher::where('user_type', 'Branch head')->first();

                    Confirm_teacher::updateOrCreate(
                        [
                            'id_teacher' => $header_teacher->id_teacher,
                            'id_document' => 3,
                            'id_project' => $this->id_project,
                            'id_position' => 4,
                        ],
                        [
                            'confirm_status' => false,
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 3
                        ],
                        [
                            'comment' => 'ผ่าน/แก้ไขใหม่'
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 3
                        ],
                        [
                            'comment' => $this->approve_fix_comment
                        ]
                    );
                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 3)
                        ->update(['confirm_status' => true]);
                } else if ($this->not_approve) {
                    $this->validate([
                        'not_approve_comment' => 'required'
                    ], [
                        'not_approve_comment.required' => 'กรุณากรอกข้อความ'
                    ]);
                    $header_teacher = Teacher::where('user_type', 'Branch head')->first();

                    Confirm_teacher::updateOrCreate(
                        [
                            'id_teacher' => $header_teacher->id_teacher,
                            'id_document' => 3,
                            'id_project' => $this->id_project,
                            'id_position' => 4,
                        ],
                        [
                            'confirm_status' => false,
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 3
                        ],
                        [
                            'comment' => 'ไม่ผ่าน'
                        ]
                    );

                    Project::where('id_project', $this->id_project)
                        ->update([
                            'project_status' => 'reject'
                        ]);
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 3
                        ],
                        [
                            'comment' => $this->not_approve_comment
                        ]
                    );

                    Confirm_teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->where('id_project', $this->id_project)
                        ->where('id_document', 3)
                        ->update(['confirm_status' => true]);
                }

                $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Branch head')->pluck('id_teacher')->toArray())
                    ->where('id_project', $this->id_project)
                    ->where('id_document', 3)
                    ->where('confirm_status', true)
                    ->exists();

                if ($confirmed) {
                    $project = Project::with(['members', 'teachers', 'advisers'])
                        ->where('id_project', $this->id_project)
                        ->first();

                    $message = 'เอกสาร คกท.-คง.-03 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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
            return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
        });
    }
    public function branch_head_approve_comment()
    {
        $this->validate([
            'branch_head_approve_fix' => 'required_without:branch_head_approve',
            'branch_head_approve' => 'required_without:branch_head_approve_fix',
        ], [
            'branch_head_approve_fix.required_without' => 'กรุณาเลือกอย่างใดอย่างหนึ่ง',
            'branch_head_approve.required_without' => 'กรุณาเลือกอย่างใดอย่างหนึ่ง',
        ]);

        if ($this->branch_head_approve_fix) {
            Comment::updateOrCreate(
                [
                    'id_document' => $this->id_document,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_project' => $this->id_project,
                    'id_comment_list' => 1,
                    'id_position' => 4
                ],
                [
                    'comment' => 'เห็นชอบให้มีการแก้ไข'
                ]
            );
            Confirm_teacher::updateOrCreate([
                'id_document' => $this->id_document,
                'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                'id_project' => $this->id_project,
            ], [
                'confirm_status' => true
            ]);
            return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
        } else if ($this->branch_head_approve) {
            Comment::updateOrCreate(
                [
                    'id_document' => $this->id_document,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_project' => $this->id_project,
                    'id_comment_list' => 1,
                    'id_position' => 4
                ],
                [
                    'comment' => 'เห็นชอบ'
                ]
            );
            Confirm_teacher::updateOrCreate([
                'id_document' => $this->id_document,
                'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                'id_project' => $this->id_project,
            ], [
                'confirm_status' => true
            ]);
            return session()->flash('success', 'บันทึกความเห็นเสร็จสิ้น');
        }

        $confirmed = Confirm_teacher::whereIn('id_teacher', Teacher::where('user_type', 'Admin')->pluck('id_teacher')->toArray())
            ->where('id_project', $this->id_project)
            ->where('id_document', 3)
            ->where('confirm_status', true)
            ->exists();

        if ($confirmed) {
            $project = Project::with(['members', 'teachers', 'advisers'])
                ->where('id_project', $this->id_project)
                ->first();

            $message = 'เอกสาร คกท.-คง.-03 ได้รับการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

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
    public function mount($id_project, $id_document)
    {
        $this->id_document = $id_document;
        $this->id_project = $id_project;
        $this->advisers = Adviser::all()->where('id_project', $this->id_project);

        $this->project = Project::with([
            'confirmStudents' => function ($query) {
                $query->where('id_document', $this->id_document)
                    ->where('id_project', $this->id_project);
            },
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers' => function ($query) {
                $query->where('id_document', $this->id_document)
                    ->where('id_project', $this->id_project);
            },
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->whereHas('confirmTeachers', function ($query) {
            $query->where('id_document', $this->id_document)->where('id_project', $this->id_project);
        })
            ->get();

        $skipIndices = [1, 5, 8]; // Indices to skip

        foreach ($this->project as $ProjectItems) {
            foreach ($ProjectItems->confirmStudents as $Student) {
                $this->score_student[$Student->student->id_student] = array_map(
                    function ($index) use ($skipIndices) {
                        return in_array($index, $skipIndices) ? null : 0;
                    },
                    array_keys(array_fill(0, count($this->criterias), 0))
                );
            }
        }
    }
    public function render()
    {

        $this->project = Project::with([
            'confirmStudents' => function ($query) {
                $query->where('id_document', $this->id_document)
                    ->where('id_project', $this->id_project);
            },
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers' => function ($query) {
                $query->where('id_document', $this->id_document)
                    ->where('id_project', $this->id_project);
            },
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->whereHas('confirmTeachers', function ($query) {
            $query->where('id_document', $this->id_document)->where('id_project', $this->id_project);
        })
            ->get();

        // dd($this->project);
        return view('livewire.document-detail.document03', ['projects' => $this->project]);
    }
}
