<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\Project;
use Livewire\Component;

class DetailThesis extends Component
{
    public $articles;
    public $members;
    public $projects;

    public function mount($id)
    {
        $this->articles = Dissertation_article::with('project')->find($id);
        $this->members = Member::with(
            'level',
            'course',
            'projects'
        )->get();
        $this->projects = Project::with(
            'members',
            'teachers',
            'advisers'
        )->where('id_project', $this->articles->id_project)->first();
    }

    public function render()
    {
        $other_articles = Dissertation_article::where('id_dissertation_article', '!=', $this->articles->id_dissertation_article)->orderBy('created_at', 'desc')->paginate(4);
        return view('livewire.thesis.detail-thesis', ['other_articles' => $other_articles]);
    }
}