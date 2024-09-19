<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class EditAndDetailTeacher extends Component
{
    use WithFileUploads;
    public $toggle = [
        'teacher_image' => false,
        'signature_image' => false,
        'prefix' => false,
        'name' => false,
        'surname' => false,
        'academic_position' => false,
        'educational_qualification' => false,
        'branch' => false,
        'email' => false,
        'tel' => false,
        'id_line' => false,
        'password' => false
    ];
    public $teacher;
    public $teacherId;
    public $teacher_image;
    public $path_teacher_image;
    public $prefix;
    public $other_prefix;
    public $name;
    public $surname;
    public $signature_image;
    public $path_signature_image;
    public $academic_position;
    public $educational_qualification;
    public $branch;
    public $email;
    public $tel;
    public $id_line;
    public $old_password, $new_password, $new_password_confirmation;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['teacher_image']) {
            $rules['teacher_image'] = 'required|image|max:2048';
        }

        if ($this->toggle['signature_image']) {
            $rules['signature_image'] = 'required|image|max:2048';
        }

        if ($this->toggle['prefix']) {
            $rules['prefix'] = 'required';
            $rules['other_prefix'] = 'required_if:prefix,อื่นๆ';
        }

        if ($this->toggle['name']) {
            $rules['name'] = 'required';
        }

        if ($this->toggle['surname']) {
            $rules['surname'] = 'required';
        }

        if ($this->toggle['academic_position']) {
            $rules['academic_position'] = 'required';
        }

        if ($this->toggle['educational_qualification']) {
            $rules['educational_qualification'] = 'required';
        }

        if ($this->toggle['branch']) {
            $rules['branch'] = 'required';
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
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'teacher_image.required' => 'กรุณาอัปโหลดรูปภาพอาจารย์',
            'teacher_image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
            'teacher_image.max' => 'ไฟล์รูปภาพต้องไม่เกิน 2MB',

            'signature_image.required' => 'กรุณาอัปโหลดรูปภาพลายเซ็น',
            'signature_image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
            'signature_image.max' => 'ไฟล์รูปภาพต้องไม่เกิน 2MB',

            'prefix.required' => 'กรุณาเลือกคํานําหน้า',
            'other_prefix.required_if' => 'กรุณากรอกคํานําหน้า',

            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',

            'academic_position.required' => 'กรุณากรอกตําแหน่ง',
            'educational_qualification.required' => 'กรุณากรอกวุฒิการศึกษา',
            'branch.required' => 'กรุณาเลือกสาขา',

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

            if (!Hash::check($this->old_password, $this->teacher->password)) {
                session()->flash('error', 'รหัสผ่านปัจจุบันไม่ถูกต้อง');
                return;
            }

            $this->teacher->password = Hash::make($this->new_password);
            $this->teacher->save();
        } else if ($index == 'teacher_image') {
            $this->path_teacher_image = $this->teacher_image->store('teacher_image', 'public');
            Teacher::where('id_teacher', $this->teacherId)->update([$index => $this->path_teacher_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else if ($index == 'signature_image') {
            $this->path_signature_image = $this->signature_image->store('signature_image', 'public');
            Teacher::where('id_teacher', $this->teacherId)->update([$index => $this->path_signature_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else if ($index == 'prefix' && $this->prefix == 'อื่นๆ') {
            Teacher::where('id_teacher', $this->teacherId)->update([$index => $this->other_prefix], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else {
            Teacher::where('id_teacher', $this->teacherId)->update([$index => $this->$index], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('teacher_image', 'signature_image', 'prefix', 'other_prefix', 'name', 'surname', 'academic_position', 'educational_qualification', 'branch', 'email', 'tel', 'old_password', 'new_password', 'new_password_confirmation');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount();
    }

    public function mount()
    {
        $this->teacher = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        $this->teacherId = $this->teacher->id_teacher;
        $this->path_teacher_image = $this->teacher->teacher_image;
        $this->path_signature_image = $this->teacher->signature_image;
        $this->other_prefix = $this->teacher->prefix;
        $this->name = $this->teacher->name;
        $this->surname = $this->teacher->surname;
        $this->academic_position = $this->teacher->academic_position;
        $this->educational_qualification = $this->teacher->educational_qualification;
        $this->branch = $this->teacher->branch;
        $this->email = $this->teacher->email;
        $this->tel = $this->teacher->tel;
        $this->id_line = $this->teacher->id_line;
        $this->old_password = null;
        $this->new_password = null;
        $this->new_password_confirmation = null;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-teacher', [
            'teacher' => $this->teacher->refresh()
        ]);
    }
}
