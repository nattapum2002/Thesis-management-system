<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginMember extends Component
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

        if (Auth::guard('members')->attempt(['username' => $this->username, 'password' => $this->password])) {
            if (Auth::guard('members')->user()->account_status == true) {
                return redirect()->route('member');
            } else {
                Auth::guard('members')->logout();
                session()->flash('message', 'รอการอนุมัติจากอาจารย์ประจำวิชา');
            }
        } else {
            // Check if the username exists first to provide a specific error message
            session()->flash('message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }
    }

    public function render()
    {
        return view('livewire.account.login-member');
    }
}