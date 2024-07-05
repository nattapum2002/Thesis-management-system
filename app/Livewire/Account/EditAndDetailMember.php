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
        'email' => false,
        'tel' => false,
        'line_id' => false,
        'password' => false,
        'account_status' => false
    ];
    public $student;
    public $studentId;
    public $student_image;
    public $path_student_image;
    public $prefix;
    public $other_prefix;
    public $name;
    public $surname;
    public $courses;
    public $course;
    public $levels;
    public $level;
    public $email;
    public $tel;
    public $line_id;
    public $password;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'student_image') {
            $this->path_student_image = $this->student_image->store('student_image', 'public');
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->path_student_image], ['updated_at' => now()]);
        } else if ($this->prefix == 'อื่นๆ') {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->other_prefix], ['updated_at' => now()]);
        } else {
            DB::table('members')->where('id_student', $this->studentId)->update([$index => $this->$index], ['updated_at' => now()]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('course', 'level');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount();
    }

    public function mount()
    {
        $this->courses = Course::all();
        $this->levels = Level::all();
        $this->student = Member::with('level', 'course')->find(Auth::guard('members')->user()->id_student);
        $this->studentId = $this->student->id_student;
        $this->path_student_image = $this->student->student_image;
        $this->other_prefix = $this->student->prefix;
        $this->name = $this->student->name;
        $this->surname = $this->student->surname;
        $this->course = $this->student->course->course;
        $this->level = $this->student->level->level;
        $this->email = $this->student->email;
        $this->tel = $this->student->tel;
        $this->line_id = $this->student->line_id;
        $this->password = $this->student->password;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-member', [
            'student' => $this->student->refresh()
        ]);
    }
}
