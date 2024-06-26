<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Director;
use App\Models\Document;
use App\Models\Position;
use App\Models\Project;

class AssignDirector extends Component
{
    public $teachers;
    public $selectedTeacher;
    public $projects;
    public $selectedProject;
    public $documents;
    public $selectedDocument;
    public $positions;
    public $selectedPosition;

    public function mount()
    {
        // ดึงข้อมูลครูทั้งหมดจากตาราง teachers
        $this->teachers = Teacher::all();
        $this->projects = Project::all();
        $this->documents = Document::whereIn('id_document', [3, 6])->get();;
        $this->positions = Position::whereIn('id_position', [5, 6, 7])->get();
    }

    public function assignDirector()
    {
        $this->validate([
            'selectedTeacher' => 'required|exists:teachers,id_teacher',
            'selectedProject' => 'required|exists:projects,id_project',
            'selectedDocument' => 'required|exists:documents,id_document',
            'selectedPosition' => 'required|exists:positions,id_position',
        ]);

        Director::create([
            'id_project' => $this->selectedProject,
            'id_document' => $this->selectedDocument,
            'id_teacher' => $this->selectedTeacher,
            'id_position' => $this->selectedPosition,
            'created_by' => auth('teachers')->id(),
        ]);

        session()->flash('message', 'กำหนดคณะกรรมกรรมการสําเร็จ');
    }

    public function render()
    {
        return view('livewire.admin.assign-director');
    }
}