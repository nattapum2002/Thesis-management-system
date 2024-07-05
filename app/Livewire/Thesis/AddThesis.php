<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddThesis extends Component
{
    use WithFileUploads;

    public $add_detail;
    public $add_thesis_image;
    public $path_thesis_image;
    public $add_thesis_file;
    public $path_thesis_file;
    public $add_year;
    public $add_type;
    public $add_status;
    public $add_project;

    public function add()
    {
        if ($this->add_thesis_image == !null) {
            $this->path_thesis_image = $this->add_thesis_image->store('thesis_image', 'public');
        }
        if ($this->add_thesis_file == !null) {
            $this->path_thesis_file = $this->add_thesis_file->store('thesis_file', 'public');
        }

        Dissertation_article::create([
            'title' => Project::where('id_project', $this->add_project)->value('project_name_th'),
            'details' => $this->add_detail,
            'thesis_image' => $this->path_thesis_image,
            'file_dissertation' => $this->path_thesis_file,
            'year_published' => $this->add_year,
            'type' => $this->add_type,
            'status' => $this->add_status,
            'id_project' => $this->add_project,
            'created_by' => null, //Auth::guard('members')->user()->id_student,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        session()->flash('message', 'เพิ่มข่าวสารสำเร็จ!');
        return redirect()->route('manage_thesis');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('manage_thesis');
    }

    public function render()
    {
        $projects = Project::with('membersProject')
            ->whereHas('membersProject', function ($query) {
                $query->where('id_student', Auth::guard('members')->user()->id_student);
            })
            ->get();

        return view('livewire.thesis.add-thesis', ['projects' => $projects]);
    }
}