<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class EditAndDetailMember extends Component
{
    use WithFileUploads;
    public $toggle = [
        'student_image' => false,
        'student_id' => false,
        'name' => false,
        'course' => false,
        'level' => false,
        'section' => false,
        'email' => false,
        'tel' => false,
        'line_id' => false
    ];
    public $student;
    public $studentId;
    public $edit_student_image;
    public $path_student_image;
    public $edit_student_id;
    public $edit_name;
    public $edit_course;
    public $edit_level;
    public $edit_section;
    public $edit_email;
    public $edit_tel;
    public $edit_line_id;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'student_image') {
            $this->path_student_image = $this->edit_student_image->store('student_image', 'public');
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->path_student_image], ['updated_at' => now()]);
        }
        if ($index == 'student_id') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_student_id], ['updated_at' => now()]);
        }
        if ($index == 'name') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_name], ['updated_at' => now()]);
        }
        if ($index == 'course') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_course], ['updated_at' => now()]);
        }
        if ($index == 'level') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_level], ['updated_at' => now()]);
        }
        if ($index == 'section') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_section], ['updated_at' => now()]);
        }
        if ($index == 'email') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_email], ['updated_at' => now()]);
        }
        if ($index == 'tel') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_tel], ['updated_at' => now()]);
        }
        if ($index == 'line_id') {
            DB::table('students')->where('id_student', $this->studentId)->update([$index => $this->edit_line_id], ['updated_at' => now()]);
        }
        $this->cancel($index);
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function cancel($index)
    {
        //$this->reset('edit_student_id', 'edit_name', 'edit_course', 'edit_level', 'edit_section', 'edit_email', 'edit_tel', 'edit_line_id');
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function mount()
    {
        $this->student = Member::find(Auth::guard('members')->user()->id_student);
        $this->studentId = $this->student->id_student;
        $this->path_student_image = $this->student->student_image;
        $this->edit_student_id = $this->student->student_id;
        $this->edit_name = $this->student->name;
        $this->edit_course = $this->student->course;
        $this->edit_level = $this->student->level;
        $this->edit_section = $this->student->section;
        $this->edit_email = $this->student->email;
        $this->edit_tel = $this->student->tel;
        $this->edit_line_id = $this->student->line_id;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-member');
    }
}
