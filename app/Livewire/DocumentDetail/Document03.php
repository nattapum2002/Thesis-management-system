<?php

namespace App\Livewire\DocumentDetail;


use App\Models\Adviser;
use App\Models\Project;
use App\Models\Score;
use App\Models\Student_project;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Document03 extends Component
{
    public $id_project, $teachers, $students, $advisers, $id_document, $project, $approve, $approve_fix, $not_approve, $approve_fix_comment, $not_approve_comment;
    // public $score_director_1 = [1 => null, 5 => null, 8 => null];
    // public $score_director_2 = [];
    // public $score_director_3 = [];
    // public $total_score_director_1 = 0;
    // public $total_score_director_2 = 0;
    // public $total_score_director_3 = 0;
    public $score_student = [];


    public $criterias = [
        ['name' => '1. บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง', 'score' => 10],
        ['name' => '2. การนำเสนอผลงาน', 'score' => ''],
        ['name' => '2.1 ไฟล์นำเสนอมีความสมบูรณ์', 'score' => 10],
        ['name' => '2.2 สัดส่วนของเนื้อหาที่นำเสนอ<br>(ควรเน้นผลการทดลองและการอภิปรายผล)', 'score' => 10],
        ['name' => '3. การตอบคำถาม ความรู้ ความเข้าใจในโครงงาน', 'score' => 10],
        ['name' => '4. ความสมบูรณ์ของเอกสารโครงงานฉบับร่าง', 'score' => ''],
        ['name' => '4.1 รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน', 'score' => 10],
        ['name' => '4.2 เนื้อหาครบถ้วน', 'score' => 10],
        ['name' => '5. ความสำเร็จของโครงงานตาม', 'score' => ''],
        ['name' => '5.1 วัตถุประสงค์ของโครงงาน', 'score' => 20],
        ['name' => '5.2 ขอบเขตของโครงงาน', 'score' => 10],
        ['name' => '6. ความพร้อมและตรงต่อเวลา', 'score' => 10],
    ];

    public function score_calculate()
    {

        // $pdf = PDF::loadView('Livewire_pdf.document_03_score', $data);
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream('test.pdf');
        // }, 'test.pdf');
        // return response()->make($pdf->stream('test.pdf'), 200, [
        //     'Content-Type' => 'application/pdf',
        // ]);
        // return $pdf->stream('test.pdf');
        $transformedData = array_map(function ($key, $value) {
            return [
                'student_id' => $key,
                'scores' => $value
            ];
        }, array_keys($this->score_student), $this->score_student);
        $skip_value = 22; // The ID value to skip

        foreach ($transformedData as $index => $value) {
            // Reset comment list ID for each new student
            $current_comment_list_id = 20;

            foreach ($value['scores'] as $scoreIndex => $score) {
                // Check if current ID needs to be skipped
                if ($current_comment_list_id == $skip_value) {
                    $current_comment_list_id++; // Skip the specific value
                }

                // Create a record for each score
                Score::create([
                    'id_student' => $value['student_id'],
                    'id_document' => $this->id_document,
                    'score' => $score,
                    'id_comment_list' => $current_comment_list_id,
                    'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
                    'id_position' => 3
                ]);

                // Increment the comment list ID after creating a record
                $current_comment_list_id++;

                // Check again to skip the specific value if needed
                if ($current_comment_list_id == $skip_value) {
                    $current_comment_list_id++; // Skip the specific value
                }
            }
        }
        // dd($transformedData);

        // dd(json_encode($transformedData, JSON_PRETTY_PRINT));
    }
    public function test()
    {
        $test = Score::where('id_student', 'S000001')
            ->where('id_document', $this->id_document)
            ->get();

        $allData = []; // Array to collect all decoded scores

        foreach ($test as $item) {
            $data = json_decode($item->score, true); // Decode JSON score

            // Check if $data is an array
            if (is_array($data)) {
                $allData = array_merge($allData, $data); // Flatten the array
            } else {
                $allData[] = (int)$data; // Handle single value
            }
        }

        // Sum up all scores
        $totalScore = array_sum($allData) / 3;

        // Output the total score
        dd($totalScore);
    }
    public function mount($id_project, $id_document)
    {
        $this->id_document = $id_document;
        $this->id_project = $id_project;
        $this->advisers = Adviser::all()->where('id_project', $this->id_project);
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
