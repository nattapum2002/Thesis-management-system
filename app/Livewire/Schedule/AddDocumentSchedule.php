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

    public function add()
    {
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
        return redirect()->route('manage_document_schedule');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('manage_document_schedule');
    }

    public function render()
    {
        $documents = Document::all();
        return view('livewire.schedule.add-document-schedule', ['documents' => $documents]);
    }
}