<?php

namespace App\Livewire\Account;

use App\Models\Member;
use App\Models\Course;
use App\Models\Level;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public $old_password, $new_password, $new_password_confirmation;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['student_image']) {
            $rules['student_image'] = 'required|mimes:jpg,jpeg,png|max:2048';
        }

        if ($this->toggle['prefix']) {
            $rules['prefix'] = 'required';
            $rules['other_prefix'] = 'required_if:prefix,อื่นๆ';
        }

        if ($this->toggle['name']) {
            $rules['name'] = 'required|string|max:255|regex:/^[^\d]*$/';
        }

        if ($this->toggle['surname']) {
            $rules['surname'] = 'required|string|max:255|regex:/^[^\d]*$/';
        }

        if ($this->toggle['course']) {
            $rules['course'] = 'required';
        }

        if ($this->toggle['level']) {
            $rules['level'] = 'required';
        }

        if ($this->toggle['email']) {
            $rules['email'] = 'required|email';
        }

        if ($this->toggle['tel']) {
            $rules['tel'] = 'required|numeric|digits:10';
        }

        if ($this->toggle['password']) {
            $rules['old_password'] = 'required|min:8';
            $rules['new_password'] = 'required|min:8|confirmed';
            $rules['new_password_confirmation'] = 'nullable|required_with:new_password';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'student_image.required' => 'กรุณาอัปโหลดรูปภาพนักเรียน',
            'student_image.mimes' => 'กรุณาเลือกไฟล์รูปภาพ jpg, jpeg, png',
            'student_image.max' => 'ไฟล์รูปภาพต้องไม่เกิน 2MB',

            'prefix.required' => 'กรุณาเลือกคํานําหน้า',
            'other_prefix.required_if' => 'กรุณากรอกคํานําหน้า',

            'name.required' => 'กรุณากรอกชื่อ',
            'name.string' => 'กรุณากรอกชื่อให้ถูกต้อง',
            'name.max' => 'ชื่อต้องไม่เกิน 255 ตัวอักษร',
            'name.regex' => 'ชื่อต้องไม่มีอักขระพิเศษ',

            'surname.required' => 'กรุณากรอกนามสกุล',
            'surname.string' => 'กรุณากรอกนามสกุลให้ถูกต้อง',
            'surname.max' => 'นามสกุลต้องไม่เกิน 255 ตัวอักษร',
            'surname.regex' => 'นามสกุลต้องไม่มีอักขระพิเศษ',

            'course.required' => 'กรุณาเลือกหลักสูตร',
            'level.required' => 'กรุณาเลือกชั้นปี',

            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',

            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.numeric' => 'กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลข',
            'tel.digits' => 'กรุณากรอกเบอร์โทรศัพท์ 10 หลัก',

            'old_password.required' => 'กรุณากรอกรหัสผ่านปัจจุบัน',
            'old_password.min' => 'รหัสผ่านปัจจุบันต้องมีอย่างน้อย 8 ตัวอักษร',

            'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่',
            'new_password.min' => 'รหัสผ่านใหม่ต้องมีอย่างน้อย 8 ตัวอักษร',
            'new_password.confirmed' => 'รหัสผ่านใหม่ไม่ตรงกัน',
            'new_password_confirmation.required_with' => 'กรุณากรอกรหัสผ่านใหม่อีกครั้ง',
        ];
    }


    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        $this->validate();

        if ($index == 'password') {

            if (!Hash::check($this->old_password, $this->student->password)) {
                session()->flash('error', 'รหัสผ่านปัจจุบันไม่ถูกต้อง');
                return;
            }

            $this->student->password = Hash::make($this->new_password);
            $this->student->save();
        } else if ($index == 'student_image') {
            $this->path_student_image = $this->student_image->storeAs('student_image', $this->student_image->getClientOriginalName(), 'public');
            Member::where('id_student', $this->studentId)->update([$index => $this->path_student_image], ['updated_at' => now()]);
        } else if ($index == 'prefix' && $this->prefix == 'อื่นๆ') {
            Member::where('id_student', $this->studentId)->update([$index => $this->other_prefix], ['updated_at' => now()]);
        } else {
            Member::where('id_student', $this->studentId)->update([$index => $this->$index], ['updated_at' => now()]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('prefix', 'student_image', 'other_prefix', 'name', 'surname', 'course', 'level', 'email', 'tel', 'line_id', 'old_password', 'new_password', 'new_password_confirmation');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount();
    }

    public function mount()
    {
        $this->courses = Course::all();
        $this->levels = Level::all();
        $this->student = Member::with('level', 'course')->find(Auth::guard('members')->user()->id_student);
        $this->studentId = $this->student->id_student;
        $this->student_image = $this->student->student_image;
        $this->other_prefix = $this->student->prefix;
        $this->name = $this->student->name;
        $this->surname = $this->student->surname;
        $this->course = $this->student->course->course;
        $this->level = $this->student->level->level;
        $this->email = $this->student->email;
        $this->tel = $this->student->tel;
        $this->line_id = $this->student->line_id;
        $this->old_password = null;
        $this->new_password = null;
        $this->new_password_confirmation = null;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-member', [
            'student' => $this->student->refresh()
        ]);
    }
}
