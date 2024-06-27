<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class AddTeacher extends Component
{
    use WithFileUploads;
    public $teacher;
    public $teacherId;
    public $add_teacher_image;
    public $path_teacher_image;
    public $add_prefix;
    public $add_other_prefix;
    public $add_name;
    public $add_surname;
    public $add_signature_image;
    public $path_signature_image;
    public $add_academic_position;
    public $add_educational_qualification;
    public $add_branch;
    public $add_email;
    public $add_tel;
    public $add_id_line;
    public $add_username;
    public $add_password;
    public $add_user_type;
    public $add_account_status;

    public function add()
    {
        if ($this->add_prefix == null) {
            $this->add_prefix = $this->add_other_prefix;
        }
        if ($this->add_teacher_image == !null) {
            $this->path_teacher_image = $this->add_teacher_image->store('teacher_image', 'public');
        }
        if ($this->add_signature_image == !null) {
            $this->path_signature_image = $this->add_signature_image->store('signature_image', 'public');
        }
        Teacher::create([
            'teacher_image' => $this->path_teacher_image,
            'signature_image' => $this->path_signature_image,
            'prefix' => $this->add_prefix,
            'name' => $this->add_name,
            'surname' => $this->add_surname,
            'academic_position' => $this->add_academic_position,
            'educational_qualification' => $this->add_educational_qualification,
            'branch' => $this->add_branch,
            'email' => $this->add_email,
            'tel' => $this->add_tel,
            'id_line' => $this->add_id_line,
            'username' => $this->add_username,
            'password' => Hash::make($this->add_password),
            'user_type' => $this->add_user_type,
            'account_status' => $this->add_account_status,
            'created_by' => Auth::guard('teachers')->user()->id_teacher,
            'created_at' => now()
        ]);
        session()->flash('message', 'เพิ่ม ' . $this->add_prefix . ' ' . $this->add_name . ' ' . $this->add_surname . ' สำเร็จ!');
        return redirect()->route('manage_teacher');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('manage_teacher');
    }

    public function render()
    {
        return view('livewire.account.add-teacher');
    }
}
