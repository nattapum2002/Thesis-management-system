<?php

// namespace App\Livewire\Account;

// use App\Models\Course;
// use App\Models\Level;
// use App\Models\Member;
// use Livewire\Component;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Str;

// class Register extends Component
// {
//     public $prefix, $other_prefix, $name, $surname, $id_level, $id_course, $id_student, $tel, $id_line, $email, $username, $password;
//     protected $rules = [];

//     public function __construct()
//     {
//         $this->rules = [
//             'prefix' => 'required',
//             'name' => 'required|string|max:255',
//             'surname' => 'required|string|max:255',
//             'id_level' => 'required',
//             'id_course' => 'required',
//             'id_student' => 'required|numeric|digits:12|unique:members,id_student',
//             'tel' => 'required|numeric|digits:10',
//             'id_line' => 'nullable|string|max:255',
//             'email' => 'required|email|max:255|unique:members,email',
//             'username' => 'required|string|max:255|unique:members,username',
//             'password' => 'required|min:8|confirmed',
//             'current_password' => 'required|required_with:password',
//         ];
//     }

//     public function register()
//     {
//         if ($this->prefix == null) {
//             $this->prefix = $this->other_prefix;
//         }

//         $this->validate();

//         Member::create([
//             'prefix' => $this->prefix,
//             'name' => $this->name,
//             'surname' => $this->surname,
//             'id_level' => $this->id_level,
//             'id_course' => $this->id_course,
//             'id_student' => $this->id_student,
//             'tel' => $this->tel,
//             'id_line' => $this->id_line,
//             'email' => $this->email,
//             'email_verified_at' => now(),
//             'username' => $this->username,
//             'password' => Hash::make($this->password),
//             'account_status' => false,
//             'remember_token' => Str::random(10),
//         ]);

//         session()->flash('message', 'สมัครสมาชิกสำเร็จ!');

//         return redirect()->route('login.member');
//     }

//     public function render()
//     {
//         return view('livewire.account.register');
//     }
// }

namespace App\Livewire\Account;

use App\Models\Course;
use App\Models\Level;
use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class Register extends Component
{
    public $prefix, $other_prefix, $name, $surname, $id_level, $id_course, $id_student, $tel, $id_line, $email, $username, $password, $password_confirmation;

    public function rules()
    {
        return [
            'prefix' => 'required',
            'other_prefix' => 'required_if:prefix,อื่นๆ',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'id_level' => 'required',
            'id_course' => 'required',
            'id_student' => 'required|numeric|digits:12|unique:members,id_student',
            'tel' => 'required|numeric|digits:10',
            'id_line' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:members,email',
            'username' => 'required|string|max:255|unique:members,username',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'nullable|required_with:password',
        ];
    }

    public function messages()
    {
        return [
            'prefix.required' => 'กรุณาเลือกคํานําหน้า',
            'other_prefix.required_if' => 'กรุณากรอกคํานําหน้า',
            'name.required' => 'กรุณากรอกชื่อ',
            'name.string' => 'ชื่อต้องเป็นตัวอักษร',
            'name.max' => 'ชื่อไม่เกิน 255 ตัวอักษร',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'surname.string' => 'นามสกุลต้องเป็นตัวอักษร',
            'surname.max' => 'นามสกุลไม่เกิน 255 ตัวอักษร',
            'id_level.required' => 'กรุณาเลือกชั้นปี',
            'id_course.required' => 'กรุณาเลือกหลักสูตร',
            'id_student.required' => 'กรุณากรอกรหัสนักศึกษา',
            'id_student.numeric' => 'รหัสนักศึกษาต้องเป็นตัวเลข',
            'id_student.digits' => 'รหัสนักศึกษาต้องเป็น 12 หลัก',
            'id_student.unique' => 'รหัสนักศึกษาซ้ํา',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.numeric' => 'เบอร์โทรศัพท์ต้องเป็นตัวเลข',
            'tel.digits' => 'เบอร์โทรศัพท์ต้องเป็น 10 หลัก',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.max' => 'อีเมลไม่เกิน 255 ตัวอักษร',
            'email.unique' => 'อีเมลซ้ํา',
            'username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'username.string' => 'ชื่อผู้ใช้งานต้องเป็นตัวอักษร',
            'username.max' => 'ชื่อผู้ใช้งานไม่เกิน 255 ตัวอักษร',
            'username.unique' => 'ชื่อผู้ใช้งานซ้ํา',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องอย่างน้อย 8 ตัวอักษร',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'password_confirmation.required_with' => 'กรุณากรอกรหัสผ่าน',
        ];
    }

    public function register()
    {
        // ถ้าไม่มี prefix ให้ใช้ other_prefix แทน
        if ($this->prefix == 'อื่นๆ') {
            $this->prefix = $this->other_prefix;
        }

        $this->validate();

        // สร้างข้อมูลสมาชิกใหม่
        Member::create([
            'prefix' => $this->prefix,
            'name' => $this->name,
            'surname' => $this->surname,
            'id_level' => $this->id_level,
            'id_course' => $this->id_course,
            'id_student' => $this->id_student,
            'tel' => $this->tel,
            'id_line' => $this->id_line,
            'email' => $this->email,
            'email_verified_at' => now(),
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'account_status' => false,
            'remember_token' => Str::random(10),
        ]);

        session()->flash('message', 'สมัครสมาชิกสำเร็จ!');

        return redirect()->route('login.member');
    }

    public function render()
    {
        return view('livewire.account.register');
    }
}
