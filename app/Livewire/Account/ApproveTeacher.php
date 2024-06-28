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
    public $user_type;
    public $account_status;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->$index], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);

        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('user_type', 'account_status');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->teacherId);
    }

    public function mount($id)
    {
        $this->teacher = Teacher::find($id);
        $this->teacherId = $this->teacher->id_teacher;
        $this->user_type = $this->teacher->user_type;
        $this->account_status = $this->teacher->account_status;
    }
    public function render()
    {
        return view('livewire.account.approve-teacher', [
            'teacher' => $this->teacher->refresh()
        ]);
    }
}
