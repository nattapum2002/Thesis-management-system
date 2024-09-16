<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Adviser;
use App\Models\Comment;
use App\Models\Confirm_teacher;
use App\Models\Project;
use App\Models\Score;
use App\Models\Student_project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Document06 extends Component
{
    public $id_project, $id_document, $students, $project, $advisers, $approve, $approve_fix, $not_approve, $approve_fix_comment, $not_approve_comment;
    public $admin_approve , $admin_approve_fix  , $admin_approve_fix_comment ;
    public $score_student = [];
    public $criterias = [
        ['name' => '1. บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง', 'score' => 5],
        ['name' => '2. การนำเสนอผลงาน', 'score' => ''],
        ['name' => '2.1 ไฟล์นำเสนอมีความสมบูรณ์', 'score' => 5],
        ['name' => '2.2 สัดส่วนของเนื้อหาที่นำเสนอ<br>(ควรเน้นผลการทดลองและการอภิปรายผล)', 'score' => 10],
        ['name' => '2.3 ทักษะการใช้ภาษาเพื่อการสื่อสาร', 'score' => 5],
        ['name' => '3. การตอบคำถาม ความรู้ ความเข้าใจในโครงงาน', 'score' => 20],
        ['name' => '4. ความสมบูรณ์ของเอกสารโครงงานฉบับร่าง', 'score' => ''],
        ['name' => '4.1 รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน', 'score' => 10],
        ['name' => '4.2 เนื้อหาครบถ้วน', 'score' => 10],
        ['name' => '5. ความสำเร็จของโครงงานตาม', 'score' => ''],
        ['name' => '5.1 วัตถุประสงค์ของโครงงาน', 'score' => 20],
        ['name' => '5.2 ขอบเขตของโครงงาน', 'score' => 15],
    ];
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

            foreach ($transformedData as $index => $value) {
                // Reset comment list ID for each new student
                $current_comment_list_id = 20;

                foreach ($value['scores'] as $scoreIndex => $score) {

                    // Create a record for each score
                    Score::updateOrCreate([
                        'id_student' => $value['student_id'],
                        'id_document' => $this->id_document,
                        'id_comment_list' => $current_comment_list_id,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_position' => 3
                    ], [
                        'score' => $score,
                    ]);

                    // Increment the comment list ID after creating a record
                    $current_comment_list_id++;
                }
            }
        });

        // dd($transformedData);

        // dd(json_encode($transformedData, JSON_PRETTY_PRINT));
    }
    public function test_summary()
    {
        DB::transaction(function () {
            if ($this->approve || $this->approve_fix || $this->not_approve) {
                if ($this->approve) {
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 6,
                        ],
                        [
                            'comment' => 'ผ่าน'
                        ]
                    );
                    Confirm_teacher::updateOrCreate([
                        'id_document' => $this->id_document,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                    ], [
                        'confirm_status' => true
                    ]);
                } else if ($this->approve_fix) {
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 6
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
                            'id_position' => 6
                        ],
                        [
                            'comment' => $this->approve_fix_comment
                        ]
                    );
                    Confirm_teacher::updateOrCreate([
                        'id_document' => $this->id_document,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                    ], [
                        'confirm_status' => true
                    ]);
                } else if ($this->not_approve) {
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 1,
                            'id_position' => 6
                        ],
                        [
                            'comment' => 'ไม่ผ่าน'
                        ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 6
                        ],
                        [
                            'comment' => $this->not_approve_comment
                        ]
                    );

                    Confirm_teacher::updateOrCreate([
                        'id_document' => $this->id_document,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                    ], [
                        'confirm_status' => false
                    ]);
                }
            }
        });
    }
    public function admin_comment()
    {
       DB::transaction(function () {
           if($this->admin_approve||$this->admin_approve_fix){
            if($this->admin_approve){
                Comment::updateOrCreate(
                    [
                        'id_document' => $this->id_document,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                        'id_comment_list' => 1,
                        'id_position' => 3
                    ],
                    [
                        'comment' => 'อนุมัติ'
                    ]
                );
            }elseif($this->admin_approve_fix){
                Comment::updateOrCreate(
                    [
                        'id_document' => $this->id_document,
                        'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                        'id_project' => $this->id_project,
                        'id_comment_list' => 1,
                        'id_position' => 3
                    ],[
                        'comment' => 'ควรปรับผลการประเมิน เป็น'
                    ]
                    );
                    Comment::updateOrCreate(
                        [
                            'id_document' => $this->id_document,
                            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                            'id_project' => $this->id_project,
                            'id_comment_list' => 2,
                            'id_position' => 3
                        ],[
                            'comment' => $this->admin_approve_fix_comment
                        ]
                        );
            }
            
           }
       });
    }
    public function mount($id_project, $id_document)
    {
        $this->id_document = $id_document;
        $this->id_project = $id_project;
        $this->students = Student_project::where('id_project', $this->id_project)->pluck('id_student');
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

        $skipIndices = [1, 6, 9]; // Indices to skip

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
        return view('livewire.document-detail.document06', ['projects' => $this->project]);
    }
}
