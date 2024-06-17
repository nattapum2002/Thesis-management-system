<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        if (Auth::guard('members')->attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            
            return redirect()->intended('/member'); //dashboard
        }

        $this->addError('username', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
    }

    public function render()
    {
        return view('livewire.login-member');
    }
}
