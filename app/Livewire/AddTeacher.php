<?php

namespace App\Livewire;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTeacher extends Component
{
    use withFileUploads;

    public $prefix, $name, $surname, $academic_position, $educational_qualification, $branch, $user_type, $email, $tel, $id_line, $teacher_image, $signature_image, $username, $password, $account_status;

    public function render()
    {
        $data = Teacher::all();
        return view('livewire.add-teacher')->with(compact('data'));
    }

    public function add()
    {
        // dd('dd');
        $data = Teacher::create([
            'prefix' => $this->prefix,
            'name' => $this->name,
            'surname' => $this->surname,
            'academic_position' => $this->academic_position,
            'educational_qualification' => $this->educational_qualification,
            'branch' => $this->branch,
            'user_type' => $this->user_type,
            'email' => $this->email,
            'tel' => $this->tel,
            'id_line' => $this->id_line,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            //'created_by' => auth()->user()->id,
        ]);

        if ($this->photo) {
            $teacher_image = $this->photo->store('teacher_image', 'public');
            $data->profile_photo_path = $teacher_image;
            $data->save();
        }
        if ($this->photo) {
            $signature_image = $this->photo->store('signature_image', 'public');
            $data->profile_photo_path = $signature_image;
            $data->save();
        }
        // try {
        //     $data = Teacher::create([
        //         'prefix' => $this->prefix,
        //         'name' => $this->name,
        //         'surname' => $this->surname,
        //         'academic_position' => $this->academic_position,
        //         'educational_qualification' => $this->educational_qualification,
        //         'branch' => $this->branch,
        //         'user_type' => $this->user_type,
        //         'email' => $this->email,
        //         'tel' => $this->tel,
        //         'id_line' => $this->id_line,
        //         'department' => $this->department,
        //         'username' => $this->username,
        //         'password' => Hash::make($this->password),
        //         'created_by' => auth()->user()->id,
        //     ]);

        //     if ($this->photo) {
        //         $teacher_image = $this->photo->store('teacher_image', 'public');

        //         $data->profile_photo_path = $teacher_image;
        //         $data->save();
        //     }
        //     if ($this->photo) {
        //         $signature_image = $this->photo->store('signature_image', 'public');

        //         $data->profile_photo_path = $signature_image;
        //         $data->save();
        //     }

        //     return redirect()->to(route('projects'));
        // } catch (\Exception $e) {
        //     //dd($e);
        //     session()->flash('error', $e->getMessage());
        // }
    }

    public function cancel()
    {
        dd('cancel');
    }
}
