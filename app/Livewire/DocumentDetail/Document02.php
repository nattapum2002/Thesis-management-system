<?php

namespace App\Livewire\DocumentDetail;

use App\Models\Adviser;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Document02 extends Component
{
    public $id_project, $teachers;
    public $id_teacher = [];

    public function test(){
        dd($this->id_teacher);
    }
    public function mount($id_project)
    {
        $this->id_project = $id_project;
    }
    public function render()
    {
        $this->teachers = Teacher::all();

        $projects = Project::with([
            'confirmStudents' => function ($query) {
                $query->where('id_document', 2)->with('student');
            },
            'confirmTeachers' => function ($query) {
                $query->where('id_document', 2)->with('teacher');
            },
            'comments.project',
            'comments.teacher'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_document', 2)
                    ->where('id_project', $this->id_project);
            })
            ->get();
        return view('livewire.document-detail.document02', ['projects' => $projects]);
    }
}
