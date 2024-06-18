<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Member;
use App\Models\Project;
use App\Models\Adviser;
use App\Models\Student_project;
use Illuminate\Support\Facades\Auth;

class Doc01MainMember extends Component
{
    public $members = [];
    public $all_teachers;
    public $project_name_th;
    public $project_name_en;
    public $advisers = [];
    public $external_advisers = [];

    // public function mount()
    // {
    //     $this->all_teachers = Teacher::all();

    //     // สมาชิกคนแรกเป็นผู้ใช้คนปัจจุบัน
    //     $this->members = [
    //         ['id_student' => Auth::user()->id_student, 'name' => Auth::user()->name . ' ' . Auth::user()->surname],
    //     ];
    // }

    // public function addMember()
    // {
    //     $this->members[] = ['id_student' => '', 'name' => ''];
    // }

    // public function removeMember($index)
    // {
    //     if ($index > 0) {
    //         unset($this->members[$index]);
    //         $this->members = array_values($this->members);
    //     }
    // }

    // public function addAdviser()
    // {
    //     $this->advisers[] = '';
    // }

    // public function removeAdviser($index)
    // {
    //     unset($this->advisers[$index]);
    //     $this->advisers = array_values($this->advisers);
    // }

    // public function addExternalAdviser()
    // {
    //     $this->external_advisers[] = ['prefix' => '', 'name' => '', 'surname' => '', 'academic_position' => '', 'educational_qualification' => '', 'branch' => ''];
    // }

    // public function removeExternalAdviser($index)
    // {
    //     unset($this->external_advisers[$index]);
    //     $this->external_advisers = array_values($this->external_advisers);
    // }

    // public function submit()
    // {
    //     // Validate and save the data
    //     $project = Project::create([
    //         'project_name_th' => $this->project_name_th,
    //         'project_name_en' => $this->project_name_en,
    //         'project_status' => 'pending', // or any default status
    //     ]);

    //     foreach ($this->members as $member) {
    //         Student_project::create([
    //             'id_student' => $member['id_student'],
    //             'id_project' => $project->id,
    //         ]);
    //     }

    //     foreach ($this->advisers as $adviser_id) {
    //         Adviser::create([
    //             'id_project' => $project->id,
    //             'id_teacher' => $adviser_id,
    //             'adviser_status' => 'main', // default status for main adviser
    //         ]);
    //     }

    //     foreach ($this->external_advisers as $external_adviser) {
    //         Adviser::create([
    //             'id_project' => $project->id,
    //             'id_teacher' => null,
    //             'adviser_status' => 'co', // default status for co-adviser
    //             'prefix' => $external_adviser['prefix'],
    //             'name' => $external_adviser['name'],
    //             'surname' => $external_adviser['surname'],
    //             'academic_position' => $external_adviser['academic_position'],
    //             'educational_qualification' => $external_adviser['educational_qualification'],
    //             'branch' => $external_adviser['branch'],
    //         ]);
    //     }

    //     session()->flash('message', 'Project and advisers have been submitted for approval.');

    //     return redirect()->route('project-approval');
    // }

    // public function render()
    // {
    //     return view('livewire.project-approval-form', [
    //         'all_teachers' => $this->all_teachers,
    //     ]);
    // }
}
