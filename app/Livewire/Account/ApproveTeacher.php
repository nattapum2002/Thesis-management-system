<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class ApproveTeacher extends Component
{
    use WithFileUploads;
    public $toggle = [
        'user_type' => false,
        'account_status' => false
    ];
    public $teacher;
    public $teacherId;
    public $edit_user_type;
    public $edit_account_status;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'user_type') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_user_type], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'account_status') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_account_status], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        $this->cancel($index);
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function cancel($index)
    {
        $this->reset('edit_user_type', 'edit_account_status');
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function mount($id)
    {
        $this->teacher = Teacher::find($id);
        $this->teacherId = $this->teacher->id_teacher;
        $this->edit_user_type = $this->teacher->user_type;
        $this->edit_account_status = $this->teacher->account_status;
    }
    public function render()
    {
        return view('livewire.account.approve-teacher');
    }
}
