<?php

namespace App\Livewire\DocumentLayout;

use App\Models\Adviser;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DocumentHead extends Component
{
    public $id_project, $id_document, $advisers;
    public function mount($id_project, $id_document)
    {
        $this->id_project = $id_project;
        $this->id_document = $id_document;
        $this->advisers = Adviser::all()->where('id_project', $this->id_project);
    }
    public function render()
    {
        $projects = Project::with([
            'confirmStudents' => function ($query) {
                $query->where('id_document', $this->id_document)->with(['student' => function ($query) {
                    $query->with('level', 'course');
                }]);
            },
            'confirmTeachers' => function ($query) {
                $query->where('id_document', $this->id_document)->with('teacher');
            },
            'comments.project',
            'comments.teacher'
        ])
            ->whereHas('confirmTeachers', function ($query) {
                $query->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                    ->where('id_document', $this->id_document)
                    ->where('id_project', $this->id_project);
            })
            ->get();
        return view('livewire.document-layout.document-head', ['projects' => $projects]);
    }
}