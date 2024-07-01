<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $password;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'teacher_image') {
            $this->path_teacher_image = $this->teacher_image->store('teacher_image', 'public');
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->path_teacher_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else if ($index == 'signature_image') {
            $this->path_signature_image = $this->signature_image->store('signature_image', 'public');
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->path_signature_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else if ($this->prefix == 'อื่นๆ') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->other_prefix], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        } else {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->$index], ['updated_at' => Auth::guard('teachers')->user()->id_teacher]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('prefix');
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
        $this->password = $this->teacher->password;
    }

    public function render()
    {
        return view('livewire.account.edit-and-detail-teacher', [
            'teacher' => $this->teacher->refresh()
        ]);
    }
}
