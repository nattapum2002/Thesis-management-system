<?php

namespace App\Livewire\Schedule;

use App\Models\Document;
use App\Models\Document_submission_schedule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditAndDetailDocumentSchedule extends Component
{
    public $toggle = [
        'id_document' => false,
        'time_submission' => false,
        'date_submission' => false,
        'year_submission' => false
    ];

    public $id_document;
    public $time_submission;
    public $date_submission;
    public $year_submission;
    public $submission;
    public $submissionId;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['id_document']) {
            $rules['id_document'] = 'required';
        }

        if ($this->toggle['time_submission']) {
            if ($this->date_submission <= now()->toDateString()) {
                $rules['time_submission'] = 'required|date_format:H:i|after_or_equal:' . now()->toTimeString();
            } else {
                $rules['time_submission'] = 'required|date_format:H:i';
            }
        }

        if ($this->toggle['date_submission']) {
            $rules['date_submission'] = 'required|date|after_or_equal:' . now()->toDateString();
        }

        if ($this->toggle['year_submission']) {
            $rules['year_submission'] = 'required';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'id_document.required' => 'กรุณาเลือกเอกสาร',

            'time_submission.required' => 'กรุณากรอกเวลา',
            'time_submission.date_format' => 'กรุณากรอกเวลาให้ถูกต้อง',
            'time_submission.after_or_equal' => 'ไม่สามารถกรอกเวลา ที่ผ่านไปแล้วได้',

            'date_submission.required' => 'กรุณากรอกวันที่',
            'date_submission.date' => 'กรุณากรอกวันที่ให้ถูกต้อง',
            'date_submission.after_or_equal' => 'ไม่สามารถกรอกวันที่ ที่ผ่านไปแล้วได้',

            'year_submission.required' => 'กรุณาเลือกปีการศึกษา',
        ];
    }

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        $this->validate();
        Document_submission_schedule::where('id_submission', $this->submissionId)->update([$index => $this->$index], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);

        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->submissionId);
    }

    public function mount($id)
    {
        $this->submission = Document_submission_schedule::find($id);
        $this->submissionId = $this->submission->id_submission;
        $this->id_document = $this->submission->id_document;
        $this->time_submission = $this->submission->time_submission;
        $this->date_submission = $this->submission->date_submission;
        $this->year_submission = $this->submission->year_submission;
    }

    public function render()
    {
        $documents = Document::all();
        return view('livewire.schedule.edit-and-detail-document-schedule', ['documents' => $documents, 'submission' => $this->submission->refresh()]);
    }
}
