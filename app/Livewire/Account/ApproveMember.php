<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class ApproveMember extends Component
{
    use WithFileUploads;
    public $toggle = [
        'account_status' => false
    ];
    public $student;
    public $studentId;
    public $account_status;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->$index], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);

        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('account_status');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->studentId);
    }

    public function mount($id)
    {
        $this->student = Member::find($id);
        $this->studentId = $this->student->id_student;
        $this->account_status = $this->student->account_status;
    }
    public function render()
    {
        return view('livewire.account.approve-member', [
            'student' => $this->student->refresh()
        ]);
    }
}
