<?php

namespace App\Livewire\Teacher;

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
    public $edit_teacher_image;
    public $path_teacher_image;
    public $edit_prefix;
    public $edit_other_prefix;
    public $edit_name;
    public $edit_surname;
    public $edit_signature_image;
    public $path_signature_image;
    public $edit_academic_position;
    public $edit_educational_qualification;
    public $edit_branch;
    public $edit_email;
    public $edit_tel;
    public $edit_id_line;
    public $edit_password;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'teacher_image') {
            $this->path_teacher_image = $this->edit_teacher_image->store('teacher_image', 'public');
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->path_teacher_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'signature_image') {
            $this->path_signature_image = $this->edit_signature_image->store('signature_image', 'public');
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->path_signature_image], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'prefix') {
            if ($this->edit_prefix == 'อื่นๆ') {
                DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_other_prefix], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
            } else {
                DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_prefix], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
            }
        }
        if ($index == 'name') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_name], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'surname') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_surname], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'academic_position') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_academic_position], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'educational_qualification') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_educational_qualification], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'branch') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_branch], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'email') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_email], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'tel') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_tel], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'id_line') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_id_line], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        if ($index == 'password') {
            DB::table('teachers')->where('id_teacher', $this->teacherId)->update([$index => $this->edit_password], ['updated_at' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        $this->cancel($index);
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function cancel($index)
    {
        $this->reset('edit_prefix');
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function mount()
    {
        $this->teacher = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        $this->teacherId = $this->teacher->id_teacher;
        $this->path_teacher_image = $this->teacher->teacher_image;
        $this->path_signature_image = $this->teacher->signature_image;
        $this->edit_other_prefix = $this->teacher->prefix;
        $this->edit_name = $this->teacher->name;
        $this->edit_surname = $this->teacher->surname;
        $this->edit_academic_position = $this->teacher->academic_position;
        $this->edit_educational_qualification = $this->teacher->educational_qualification;
        $this->edit_branch = $this->teacher->branch;
        $this->edit_email = $this->teacher->email;
        $this->edit_tel = $this->teacher->tel;
        $this->edit_id_line = $this->teacher->id_line;
        $this->edit_password = $this->teacher->password;
    }

    public function render()
    {
        return view('livewire.admin.edit-and-detail-teacher');
    }
}