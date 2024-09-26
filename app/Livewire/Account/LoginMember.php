<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginMember extends Component
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

        if (Auth::guard('members')->attempt(['username' => $this->username, 'password' => $this->password])) {
            if (Auth::guard('members')->user()->account_status == true) {
                return redirect()->route('member.dashboard');
            } else {
                Auth::guard('members')->logout();
                session()->flash('messageInfo', 'รอการอนุมัติจากอาจารย์ประจำวิชา');
            }
        } else {
            // Check if the username exists first to provide a specific error message
            session()->flash('messageDanger', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }
    }

    public function render()
    {   
        return view('livewire.account.login-member');
    }
}
