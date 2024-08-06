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
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->paginate(15);

        return view('livewire.account.manage-teacher', ['teachers' => $teachers]);
    }
}