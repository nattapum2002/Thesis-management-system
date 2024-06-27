<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends Component
{
    public $prefix, $other_prefix, $name, $surname, $id_level, $id_course, $id_student, $tel, $id_line, $email, $username, $password;

    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            'prefix' => 'required',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'id_level' => 'required',
            'id_course' => 'required',
            'id_student' => 'required|numeric|digits:12|unique:members,id_student',
            'tel' => 'required|numeric|digits:10',
            'id_line' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:members,email',
            'username' => 'required|string|max:255|unique:members,username',
        ];
    }

    public function register()
    {
        if ($this->prefix == null) {
            $this->prefix = $this->other_prefix;
        }

        $this->validate();

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

        return redirect()->route('login_member');
    }

    public function render()
    {
        return view('livewire.account.register');
    }
}