<?php

namespace App\Livewire\Thesis;

use Livewire\Component;
use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\Student_project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ManageThesis extends Component
{
    use WithPagination;

    public $users, $search = '', $filterType = 'all', $sortField = 'id_dissertation_article', $sortDirection = 'asc';
    public $filterApprove = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => 'all'],
    ];

    public function mount()
    {
        $this->users = Auth::guard('members')->user();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField == $field
            ? ($this->sortDirection == 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortField = $field;
    }

    public function toggleVisibility($index, $status)
    {
        Dissertation_article::where('id_dissertation_article', $index)
            ->update(['status' => $status]);

        $message = $status ? 'แสดงบทความ' : 'ซ่อนบทความ';
        session()->flash($status ? 'success' : 'danger', "{$message} " . Dissertation_article::find($index)->title . ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $studentId = Auth::guard('members')->user()->id_student;
        $projectIds = Student_project::where('id_student', $studentId)->pluck('id_project');

        $thesis = Dissertation_article::whereIn('id_project', $projectIds)
            ->when($this->search, fn($query) => $query->where('title', 'like', "%{$this->search}%"))
            ->when($this->filterType != 'all', fn($query) => $query->where('type', $this->filterType))
            ->when($this->filterApprove != 'all', fn($query) => $query->where('status', $this->filterApprove))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.manage-thesis', compact('thesis', 'types'));
    }
}
