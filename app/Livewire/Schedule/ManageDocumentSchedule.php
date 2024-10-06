<?php

namespace App\Livewire\Schedule;

use App\Models\Document_submission_schedule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageDocumentSchedule extends Component
{
    use WithPagination;

    public $search = '';
    public $filterApprove = 'all';
    public $sortField = 'id_submission';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function show($index)
    {
        Document_submission_schedule::where('id_submission', $index)->update([
            'status' => '0'
        ]);
        session()->flash('danger', 'ระงับกำหนดการ ID ที่ ' . Document_submission_schedule::find($index)->id_document .  ' เรียบร้อยแล้ว');
    }

    public function hide($index)
    {
        Document_submission_schedule::where('id_submission', $index)->update([
            'status' => '1'
        ]);
        session()->flash('success', 'ใช้งานกำหนดการ ID ที่ ' . Document_submission_schedule::find($index)->id_document .  ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $documents_schedule = Document_submission_schedule::with('document')
            ->when($this->search, function ($query) {
                $query->Where('id_submission', 'like', '%' . $this->search . '%')
                    ->orWhere('time_submission', 'like', '%' . $this->search . '%')
                    ->orWhere('date_submission', 'like', '%' . $this->search . '%')
                    ->orWhere('year_submission', 'like', '%' . $this->search . '%')
                    ->orWhere('id_document', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterApprove != 'all', function ($query) {
                $query->where('status', $this->filterApprove);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        return view('livewire.schedule.manage-document-schedule', ['documents_schedule' => $documents_schedule]);
    }
}
