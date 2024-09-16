<?php

// namespace App\Livewire\Account;

// use Livewire\Component;
// use App\Models\Teacher;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Livewire\WithFileUploads;

// class AddTeacher extends Component
// {
//     use WithFileUploads;
//     public $teacher;
//     public $teacherId;
//     public $add_teacher_image;
//     public $path_teacher_image;
//     public $add_prefix;
//     public $add_other_prefix;
//     public $add_name;
//     public $add_surname;
//     public $add_signature_image;
//     public $path_signature_image;
//     public $add_academic_position;
//     public $add_educational_qualification;
//     public $add_branch;
//     public $add_email;
//     public $add_tel;
//     public $add_id_line;
//     public $add_username;
//     public $add_password, $add_password_confirmation;
//     public $add_user_type;
//     public $add_account_status;

//     protected function rules()
//     {
//         return [
//             'add_teacher_image' => 'required',
//             'add_prefix' => 'required',
//             'add_other_prefix' => 'required_if:add_prefix,อื่นๆ',
//             'add_name' => 'required',
//             'add_surname' => 'required',
//             'add_academic_position' => 'required',
//             'add_educational_qualification' => 'required',
//             'add_branch' => 'required',
//             'add_email' => 'required|email|unique:teachers,email',
//             'add_tel' => 'required|numeric|digits:10|unique:teachers,tel',
//             'add_id_line' => 'required',
//             'add_username' => 'required|unique:teachers,username|min:8',
//             'add_password' => 'required|min:8|confirmed',
//             'add_password_confirmation' => 'nullable|required_with:add_password',
//             'add_user_type' => 'required',
//             'add_account_status' => 'required',
//         ];
//     }

//     protected function messages()
//     {
//         return [
//             'add_teacher_image.required' => 'กรุณาเลือกไฟล์ภาพ',
//             'add_prefix.required' => 'กรุณาเลือกคํานําหน้า',
//             'add_other_prefix.required_if' => 'กรุณากรอกคํานําหน้า',
//             'add_name.required' => 'กรุณากรอกชื่อ',
//             'add_surname.required' => 'กรุณากรอกนามสกุล',
//             'add_academic_position.required' => 'กรุณากรอกตําแหน่ง',
//             'add_educational_qualification.required' => 'กรุณากรอกวุฒิการศึกษา',
//             'add_branch.required' => 'กรุณาเลือกสาขา',
//             'add_email.required' => 'กรุณากรอกอีเมล',
//             'add_email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
//             'add_tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
//             'add_tel.numeric' => 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
//             'add_tel.digits' => 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
//             'add_id_line.required' => 'กรุณากรอกไอดีไลน์',
//             'add_username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
//             'add_username.min' => 'กรุณากรอกชื่อผู้ใช้งานอย่างน้อย 8 ตัวอักษร',
//             'add_password.required' => 'กรุณากรอกรหัสผ่าน',
//             'add_password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
//             'add_password_confirmation.required_with' => 'กรุณาตรวจสอบรหัสผ่านอีกครั้ง',
//             'add_user_type.required' => 'กรุณาเลือกประเภทผู้ใช้งาน',
//             'add_account_status.required' => 'กรุณาเลือกสถานะผู้ใช้งาน',
//         ];
//     }

//     public function add()
//     {
//         $this->validate();
//         if ($this->add_prefix == null) {
//             $this->add_prefix = $this->add_other_prefix;
//         }
//         if ($this->add_teacher_image == !null) {
//             $this->path_teacher_image = $this->add_teacher_image->store('teacher_image', 'public');
//         }
//         if ($this->add_signature_image == !null) {
//             $this->path_signature_image = $this->add_signature_image->store('signature_image', 'public');
//         }
//         Teacher::create([
//             'teacher_image' => $this->path_teacher_image,
//             'signature_image' => $this->path_signature_image,
//             'prefix' => $this->add_prefix,
//             'name' => $this->add_name,
//             'surname' => $this->add_surname,
//             'academic_position' => $this->add_academic_position,
//             'educational_qualification' => $this->add_educational_qualification,
//             'branch' => $this->add_branch,
//             'email' => $this->add_email,
//             'tel' => $this->add_tel,
//             'id_line' => $this->add_id_line,
//             'username' => $this->add_username,
//             'password' => Hash::make($this->add_password),
//             'user_type' => $this->add_user_type,
//             'account_status' => $this->add_account_status,
//             'created_by' => Auth::guard('teachers')->user()->id_teacher,
//             'created_at' => now()
//         ]);
//         session()->flash('message', 'เพิ่ม ' . $this->add_prefix . ' ' . $this->add_name . ' ' . $this->add_surname . ' เรียบร้อยแล้ว');
//         return redirect()->route('manage_teacher');
//     }

//     public function cancel()
//     {
//         $this->reset();
//         return redirect()->route('manage_teacher');
//     }

//     public function render()
//     {
//         return view('livewire.account.add-teacher');
//     }
// }

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class AddTeacher extends Component
{
    use WithFileUploads;

    public $add_teacher_image, $add_prefix, $add_other_prefix, $add_name, $add_surname, $add_signature_image, $add_academic_position, $add_educational_qualification, $add_branch, $add_email, $add_tel, $add_id_line, $add_username, $add_password, $add_password_confirmation, $add_user_type, $add_account_status;

    protected function rules()
    {
        return [
            'add_teacher_image' => 'required|image|max:2048',
            'add_prefix' => 'required',
            'add_other_prefix' => 'required_if:add_prefix,อื่นๆ',
            'add_name' => 'required',
            'add_surname' => 'required',
            'add_academic_position' => 'required',
            'add_educational_qualification' => 'required',
            'add_branch' => 'required',
            'add_email' => 'required|email|unique:teachers,email',
            'add_tel' => 'required|numeric|digits:10',
            'add_username' => 'required|unique:teachers,username',
            'add_password' => 'required|min:8|confirmed',
            'add_password_confirmation' => 'nullable|required_with:add_password',
            'add_user_type' => 'required',
            'add_account_status' => 'required',
            'add_signature_image' => 'nullable|image|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'add_teacher_image.required' => 'กรุณาเลือกไฟล์ภาพ',
            'add_signature_image.required' => 'กรุณาเลือกไฟล์ภาพ',
            'add_teacher_image.image' => 'กรุณาเลือกไฟล์ภาพให้ถูกต้อง',
            'add_signature_image.image' => 'กรุณาเลือกไฟล์ภาพให้ถูกต้อง',
            'add_teacher_image.max' => 'ไฟล์ภาพต้องมีขนาดไม่เกิน 2 MB',
            'add_signature_image.max' => 'ไฟล์ภาพต้องมีขนาดไม่เกิน 2 MB',
            'add_prefix.required' => 'กรุณาเลือกคํานําหน้า',
            'add_other_prefix.required_if' => 'กรุณากรอกคํานําหน้า',
            'add_name.required' => 'กรุณากรอกชื่อ',
            'add_surname.required' => 'กรุณากรอกนามสกุล',
            'add_academic_position.required' => 'กรุณากรอกตําแหน่ง',
            'add_educational_qualification.required' => 'กรุณากรอกวุฒิการศึกษา',
            'add_branch.required' => 'กรุณากรอกสาขา',
            'add_email.required' => 'กรุณากรอกอีเมล',
            'add_email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
            'add_tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'add_tel.numeric' => 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
            'add_tel.digits' => 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
            'add_username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'add_password.required' => 'กรุณากรอกรหัสผ่าน',
            'add_password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
            'add_password.confirmed' => 'กรุณากรอกรหัสผ่านให้ตรงกัน',
            'add_password_confirmation.required_with' => 'กรุณากรอกรหัสผ่านอีกครั้ง',
            'add_user_type.required' => 'กรุณาเลือกประเภทผู้ใช้งาน',
            'add_account_status.required' => 'กรุณาเลือกสถานะผู้ใช้งาน',
        ];
    }

    public function add()
    {
        $this->validate();

        Teacher::create([
            'teacher_image' => $this->add_teacher_image ? $this->add_teacher_image->store('teacher_image', 'public') : null,
            'signature_image' => $this->add_signature_image ? $this->add_signature_image->store('signature_image', 'public') : null,
            'prefix' => $this->add_prefix == 'อื่นๆ' ? $this->add_other_prefix : $this->add_prefix,
            'name' => $this->add_name,
            'surname' => $this->add_surname,
            'academic_position' => $this->add_academic_position,
            'educational_qualification' => $this->add_educational_qualification,
            'branch' => $this->add_branch,
            'email' => $this->add_email,
            'tel' => $this->add_tel,
            'id_line' => null,
            'username' => $this->add_username,
            'password' => Hash::make($this->add_password),
            'user_type' => $this->add_user_type,
            'account_status' => $this->add_account_status,
            'created_by' => Auth::guard('teachers')->user()->id_teacher,
            'created_at' => now()
        ]);

        session()->flash('message', 'เพิ่ม ' . $this->add_prefix . ' ' . $this->add_name . ' ' . $this->add_surname . ' เรียบร้อยแล้ว');
        return redirect()->route('admin.manage.teacher');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('admin.manage.teacher');
    }

    public function render()
    {
        return view('livewire.account.add-teacher');
    }
}
