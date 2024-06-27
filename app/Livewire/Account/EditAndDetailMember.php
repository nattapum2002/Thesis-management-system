<?php

namespace App\Livewire\Account;

use App\Models\Member;
use App\Models\Course;
use App\Models\Level;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class EditAndDetailMember extends Component
{
    use WithFileUploads;
    public $toggle = [
        'student_image' => false,
        'student_id' => false,
        'prefix' => false,
        'name' => false,
        'surname' => false,
        'course' => false,
        'level' => false,
        'sector' => false,
        'email' => false,
        'tel' => false,
        'line_id' => false,
        'password' => false,
        'account_status' => false

    ];
    public $student;
    public $studentId;
    public $edit_student_image;
    public $path_student_image;
    public $edit_prefix;
    public $edit_other_prefix;
    public $edit_name;
    public $edit_surname;
    public $courses;
    public $edit_course;
    public $levels;
    public $edit_level;
    public $edit_sector;
    public $edit_email;
    public $edit_tel;
    public $edit_line_id;
    public $edit_password;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'student_image') {
            $this->path_student_image = $this->edit_student_image->store('student_image', 'public');
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->path_student_image], ['updated_at' => now()]);
        }
        if ($index == 'prefix') {
            if ($this->edit_prefix == 'อื่นๆ') {
                DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_other_prefix], ['updated_at' => now()]);
            } else {
                DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_prefix], ['updated_at' => now()]);
            }
        }
        if ($index == 'name') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_name], ['updated_at' => now()]);
        }
        if ($index == 'surname') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_name], ['updated_at' => now()]);
        }
        if ($index == 'course') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_course], ['updated_at' => now()]);
        }
        if ($index == 'level') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_level], ['updated_at' => now()]);
        }
        if ($index == 'sector') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_sector], ['updated_at' => now()]);
        }
        if ($index == 'email') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_email], ['updated_at' => now()]);
        }
        if ($index == 'tel') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_tel], ['updated_at' => now()]);
        }
        if ($index == 'line_id') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_line_id], ['updated_at' => now()]);
        }
        if ($index == 'password') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->edit_line_id], ['updated_at' => now()]);
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
        $this->courses = Course::all();
        $this->levels = Level::all();
        $this->student = Member::with('level', 'course')->find(Auth::guard('members')->user()->id_student);
        $this->studentId = $this->student->id_student;
        $this->path_student_image = $this->student->student_image;
        $this->edit_other_prefix = $this->student->prefix;
        $this->edit_name = $this->student->name;
        $this->edit_surname = $this->student->surname;
        $this->edit_course = $this->student->course->course;
        $this->edit_level = $this->student->level->level;
        $this->edit_sector = $this->student->level->sector;
        $this->edit_email = $this->student->email;
        $this->edit_tel = $this->student->tel;
        $this->edit_line_id = $this->student->line_id;
        $this->edit_password = $this->student->password;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-member');
    }
}
