<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTeacher extends Component
{
    public $username;
    public $password;
    public $remember = false;

    protected $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('teachers')->attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            if (Auth::guard('teachers')->user()->user_type == 'Teacher') {
                return redirect()->route('teacher');
            } else if (Auth::guard('teachers')->user()->user_type == 'Admin') {
                return redirect()->route('admin');
<<<<<<< HEAD
            } else if (Auth::guard('teachers')->user()->user_type == 'Brand head') {
=======
            }
            elseif(Auth::guard('teachers')->user()->user_type == 'Branch head'){
>>>>>>> 56c744368811bca230650e816ec2acedaf719cad
                return redirect()->route('brand-head');
            }
        }

        $this->addError('username', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
    }

    public function render()
    {
        return view('livewire.login-teacher');
    }
}
