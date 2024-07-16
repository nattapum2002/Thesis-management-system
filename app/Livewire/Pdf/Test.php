<?php

namespace App\Livewire\Pdf;

use App\Models\Member;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Test extends Component
{
    public $name;
    public $member;
    public $projects;

    public function generatePDF()
    {
        // เพิ่มเวลาสูงสุดในการประมวลผล
        // set_time_limit(300); // 300 วินาที

        // $data = [
        //     'name' => $this->name,
        //     'projects' => $this->projects,
        // ];
        $projects = Project::all();
        $pdf = PDF::loadView('pdf.document', ['projects' => $projects]);
        $pdf->setPaper('a4', 'portrait');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'document.pdf');
    }

    // public function mount($id)
    // {
    //     $this->projects = Project::find(1);
    // }

    public function render()
    {
        return view('livewire.pdf.test');
    }
}
