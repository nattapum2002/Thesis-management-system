<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMember extends Component
{
    use WithPagination;

    public $search = '';
    public $editingId;
    public $editingVar;
    public $filterApprove = 'all';
    public $sortField = 'id_student';
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
        Member::where('id_student', $index)->update([
            'account_status' => '0'
        ]);
        session()->flash('danger', 'ระงับบัญชีของ ' . Member::find($index)->prefix . ' ' . Member::find($index)->name . ' ' . Member::find($index)->surname . ' เรียบร้อยแล้ว');
    }
    public function hide($index)
    {
        Member::where('id_student', $index)->update([
            'account_status' => '1'
        ]);
        session()->flash('success', 'อนุมัติบัญชีของ ' . Member::find($index)->prefix . ' ' . Member::find($index)->name . ' ' . Member::find($index)->surname . ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $members = Member::with('course', 'level')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%')
                    ->orWhere('id_student', 'like', '%' . $this->search . '%')
                    ->orWhere('prefix', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterApprove != 'all', function ($query) {
                $query->where('account_status', $this->filterApprove);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
        return view('livewire.account.manage-member', ['members' => $members]);
    }
}
