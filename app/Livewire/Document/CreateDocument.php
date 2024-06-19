<?php

namespace App\Livewire\Document;

use App\Models\Member;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class CreateDocument extends Component
{
    public $id_members = [];

    public $id_teacher = [] ;

    public $teacher ;

    protected $rules = [
        'id_members.*' => 'nullable|string', // validate array of integers
    ];
    public function  create_document(){

        // $this->validate();
        dd($this->id_teacher);
        DB::transaction(function () {
            $memberIds = collect($this->id_members)
                ->filter() // กรองค่าที่ไม่ใช่ null
                ->map(function ($id_student) {
                    return Member::firstOrCreate(['id_student' => $id_student])->id_student;
                })
                ->toArray();

            // $project = Project::create([
            //     'project_name_th' => 'Project A',
            //     'project_name_en' => 'Project A',
            //     'project_status' => 0,
            // ]);

            // $project->members()->sync($memberIds);
            
        });


        session()->flash('message', 'Document created successfully!');

    }
    public function mount()
    {
        // กำหนดค่าเริ่มต้นให้กับ id_members[0]
        $this->id_members[0] = Auth::guard('members')->user()->id_student;
        $this->teacher = Teacher::all();
    }
    public function render()
    {
        return view('livewire.document.create-document');
    }
}
