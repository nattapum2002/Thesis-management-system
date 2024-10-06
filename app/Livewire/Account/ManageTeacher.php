<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\WithPagination;

class ManageTeacher extends Component
{
    use WithPagination;

    public $search = '';
    public $editingId;
    public $editingVar;
    public $filterApprove = 'all';
    public $sortField = 'id_teacher';
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
        Teacher::where('id_teacher', $index)->update([
            'account_status' => '0'
        ]);
        session()->flash('danger', 'ระงับบัญชีของ ' . Teacher::find($index)->prefix . ' ' . Teacher::find($index)->name . ' ' . Teacher::find($index)->surname . ' เรียบร้อยแล้ว');
    }
    public function hide($index)
    {
        Teacher::where('id_teacher', $index)->update([
            'account_status' => '1'
        ]);
        session()->flash('success', 'อนุมัติบัญชีของ ' . Teacher::find($index)->prefix . ' ' . Teacher::find($index)->name . ' ' . Teacher::find($index)->surname . ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $teachers = Teacher::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%')
                    ->orWhere('prefix', 'like', '%' . $this->search . '%')
                    ->orWhere('user_type', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterApprove != 'all', function ($query) {
                $query->where('account_status', $this->filterApprove);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.account.manage-teacher', ['teachers' => $teachers]);
    }
}
