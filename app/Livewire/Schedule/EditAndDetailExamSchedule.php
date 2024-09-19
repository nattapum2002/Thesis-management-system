<?php

namespace App\Livewire\Schedule;

use App\Models\Director;
use App\Models\Exam_schedule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class EditAndDetailExamSchedule extends Component
{
    public $toggle = [
        'exam_time' => false,
        'exam_day' => false,
        'year_published' => false,
        'semester' => false,
        'exam_room' => false,
        'exam_building' => false,
        'exam_group' => false
    ];

    public $exam_schedule;
    public $id_exam_schedule, $exam_time, $exam_day, $exam_room, $exam_building, $exam_group, $year_published, $semester;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['exam_time']) {
            if ($this->exam_day <= now()->toDateString()) {
                $rules['exam_time'] = 'required|date_format:H:i|after_or_equal:' . now()->toTimeString();
            } else {
                $rules['exam_time'] = 'required|date_format:H:i';
            }
        }

        if ($this->toggle['exam_day']) {
            $rules['exam_day'] = 'required|date|after_or_equal:' . now()->toDateString();
        }

        if ($this->toggle['year_published']) {
            $rules['year_published'] = 'required';
        }

        if ($this->toggle['semester']) {
            $rules['semester'] = 'required';
        }

        if ($this->toggle['exam_room']) {
            $rules['exam_room'] = 'required';
        }

        if ($this->toggle['exam_building']) {
            $rules['exam_building'] = 'required';
        }

        if ($this->toggle['exam_group']) {
            $rules['exam_group'] = 'required';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'exam_time.required' => 'กรุณากรอกเวลา',
            'exam_time.date_format' => 'กรุณากรอกเวลาให้ถูกต้อง',
            'exam_time.after_or_equal' => 'ไม่สามารถกรอกเวลา ที่ผ่านไปแล้วได้ ถ้ายังไม่ผ่านกรุณาตรวจสอบวันที่ก่อน',

            'exam_day.required' => 'กรุณากรอกวันที่',
            'exam_day.date' => 'กรุณากรอกวันที่ให้ถูกต้อง',
            'exam_day.after_or_equal' => 'ไม่สามารถกรอกวันที่ ที่ผ่านไปแล้วได้',

            'year_published.required' => 'กรุณาเลือกปีที่',

            'semester.required' => 'กรุณาเลือกภาคเรียน',

            'exam_room.required' => 'กรุณากรอกห้อง',

            'exam_building.required' => 'กรุณากรอกอาคาร',

            'exam_group.required' => 'กรุณากรอกกลุ่ม',
        ];
    }

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        $this->validate();

        Exam_schedule::where('id_exam_schedule', $this->id_exam_schedule)->update([$index => $this->$index], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);

        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->id_exam_schedule);
    }

    public function mount($id)
    {
        $this->exam_schedule = Exam_schedule::find($id);
        $this->id_exam_schedule = $this->exam_schedule->id_exam_schedule;
        $this->exam_time = $this->exam_schedule->exam_time;
        $this->exam_day = $this->exam_schedule->exam_day;
        $this->exam_room = $this->exam_schedule->exam_room;
        $this->exam_building = $this->exam_schedule->exam_building;
        $this->exam_group = $this->exam_schedule->exam_group;
        $this->year_published = $this->exam_schedule->year_published;
        $this->semester = $this->exam_schedule->semester;
    }

    public function render()
    {
        $directors = Director::with('project', 'teacher', 'document')->get();
        $examsSchedule = $this->exam_schedule;
        return view('livewire.schedule.edit-and-detail-exam-schedule', ['examsSchedule' => $examsSchedule, 'directors' => $directors]);
    }
}
