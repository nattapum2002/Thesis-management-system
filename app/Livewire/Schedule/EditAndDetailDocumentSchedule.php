<?php

namespace App\Livewire\Schedule;

use App\Models\Document;
use App\Models\Document_submission_schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        DB::table('document_submission_schedules')->where('id_submission', $this->submissionId)->update([$index => $this->$index], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);

        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('id_document');
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
