<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTeacher extends Component
{
    public $username;
    public $password;
    public $remember = false;

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'username.string' => 'ชื่อผู้ใช้งานต้องเป็นตัวอักษร',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องอย่างน้อย 8 ตัวอักษร',
        ];
    }

    public function login()
    {
        $this->validate();

        if (Auth::guard('teachers')->attempt(['username' => $this->username, 'password' => $this->password])) {
            if (Auth::guard('teachers')->user()->account_status == true) {
                if (Auth::guard('teachers')->user()->user_type == 'Teacher') {
                    return redirect()->route('teacher');
                } else if (Auth::guard('teachers')->user()->user_type == 'Admin') {
                    return redirect()->route('admin');
                } elseif (Auth::guard('teachers')->user()->user_type == 'Branch head') {
                    return redirect()->route('brand-head');
                }
            } else {
                Auth::guard('teachers')->logout();
                session()->flash('message', 'บัญชีของคุณถูกระงับการใช้งาน กรุณาติดต่ออาจารย์ประจำวิชา');
            }
        } else {
            // Check if the username exists first to provide a specific error message
            session()->flash('message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }

        $this->addError('username', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
    }

    public function render()
    {
        return view('livewire.account.login-teacher');
    }
}
