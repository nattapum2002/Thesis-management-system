<?php

namespace App\Livewire\Schedule;

use App\Models\Document;
use App\Models\Document_submission_schedule;
use Livewire\Component;

class AddDocumentSchedule extends Component
{
    public $add_document;
    public $add_time;
    public $add_date;
    public $add_year;

    protected function rules()
    {
        $rules = [
            'add_document' => 'required',
            'add_date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'add_year' => 'required',
        ];

        if ($this->add_date <= now()->toDateString()) {
            $rules['add_time'] = 'required|date_format:H:i|after_or_equal:' . now()->toTimeString();
        } else {
            $rules['add_time'] = 'required|date_format:H:i';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'add_document.required' => 'กรุณาเลือกเอกสาร',

            'add_time.required' => 'กรุณาเลือกเวลา',
            'add_time.date_format' => 'รูปแบบเวลาไม่ถูกต้อง',
            'add_time.after_or_equal' => 'ไม่สามารถกรอกเวลา ที่ผ่านไปแล้วได้ ถ้ายังไม่ผ่านกรุณาตรวจสอบวันที่ก่อน',

            'add_date.required' => 'กรุณาเลือกวันที่',
            'add_date.date' => 'รูปแบบวันที่ไม่ถูกต้อง',
            'add_date.after_or_equal' => 'ไม่สามารถกรอกวันที่ ที่ผ่านไปแล้วได้',

            'add_year.required' => 'กรุณาเลือกปีการศึกษา',
        ];
    }

    public function add()
    {
        $this->validate();
        Document_submission_schedule::create([
            'time_submission' => $this->add_time,
            'date_submission' => $this->add_date,
            'year_submission' => $this->add_year,
            'id_document' => $this->add_document,
            'created_by' => null, //Auth::guard('members')->user()->id_student,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        session()->flash('success', 'เพิ่มกำหนดการส่งเอกสารเรียบร้อยแล้ว');
        return redirect()->route('admin.manage.document.schedule');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('admin.manage.document.schedule');
    }

    public function render()
    {
        $documents = Document::all();
        return view('livewire.schedule.add-document-schedule', ['documents' => $documents]);
    }
}
