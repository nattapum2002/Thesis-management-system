<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use App\Models\Member;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditAnddetailThesis extends Component
{
    use WithFileUploads;

    public $toggle = [
        'title' => false,
        'details' => false,
        'thesis_image' => false,
        'file_dissertation' => false,
        'year_published' => false,
        'type' => false,
        'status' => false,
        'project' => false
    ];

    public $thesis;
    public $thesisId;
    public $title;
    public $details;
    public $year_published;
    public $thesis_image;
    public $path_thesis_image;
    public $file_dissertation;
    public $path_thesis_file;
    public $type;
    public $status;
    public $users;
    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'thesis_image') {
            $this->path_thesis_image = $this->thesis_image->store('thesis_image', 'public');
            DB::table('dissertation_articles')->where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_image], ['updated_at' => now()]);
        } else if ($index == 'thesis_file') {
            $this->path_thesis_file = $this->file_dissertation->store('thesis_file', 'public');
            DB::table('dissertation_articles')->where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_file], ['updated_at' => now()]);
        } else if ($index == 'title') {
            DB::table('dissertation_articles')->where('id_dissertation_article', $this->thesisId)->update([$index => Project::where('id_project', $this->$index)->value('project_name_th')], ['updated_at' => now()]);
        } else {
            DB::table('dissertation_articles')->where('id_dissertation_article', $this->thesisId)->update([$index => $this->$index], ['updated_at' => now()]);
        }
        session()->flash('message', 'แก้ไขข่าวสารสำเร็จ!');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('type', 'status');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->thesisId);
    }

    public function mount($id)
    {
        $this->thesis = Dissertation_article::find($id);
        $this->thesisId = $this->thesis->id_dissertation_article;
        $this->title = $this->thesis->title;
        $this->details = $this->thesis->details;
        $this->year_published = $this->thesis->year_published;
        $this->path_thesis_image = $this->thesis->thesis_image;
        $this->path_thesis_file = $this->thesis->file_dissertation;
        $this->type = $this->thesis->type;
        $this->status = $this->thesis->status;

        if (Auth::guard('teachers')->check()) {
            $this->users = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        }
        if (Auth::guard('members')->check()) {
            $this->users = Member::find(Auth::guard('members')->user()->id_student);
        }
    }
    public function render()
    {
        if (Auth::guard('teachers')->check()) {
            return view('livewire.thesis.edit-and-detail-thesis');
        } else {
            $projects = Project::with('membersProject')
                ->whereHas('membersProject', function ($query) {
                    $query->where('id_student', Auth::guard('members')->user()->id_student);
                })
                ->get();
            return view('livewire.thesis.edit-and-detail-thesis', [
                'thesis' => $this->thesis->refresh(), 'projects' => $projects,
            ]);
        }
    }
}
