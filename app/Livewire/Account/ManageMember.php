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
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->paginate(15);

        return view('livewire.account.manage-member', ['members' => $members]);
    }
}
