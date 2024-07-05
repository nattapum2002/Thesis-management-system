<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use Livewire\Component;

class DetailThesisLogin extends Component
{
    public $thesis;

    public function mount($id)
    {
        $this->thesis = Dissertation_article::with('project')->find($id);
    }

    public function render()
    {
        $projects = Project::with('members')->where('id_project', $this->thesis->id_project)->get();
        return view('livewire.thesis.detail-thesis-login', ['projects' => $projects]);
    }
}
