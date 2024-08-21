<?php

namespace App\Livewire\Thesis;

use App\Models\Member;
use App\Models\Teacher;
use App\Models\Project;
use App\Models\Dissertation_article;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DetailThesisLogin extends Component
{
    public $users;
    public $thesis;
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

        $this->thesis = Dissertation_article::with('project')->find($id);
        if (Auth::guard('teachers')->check()) {
            $this->users = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        }
        if (Auth::guard('members')->check()) {
            $this->users = Member::find(Auth::guard('members')->user()->id_student);
        }
    }

    public function render()
    {
        $other_articles = Dissertation_article::where('id_dissertation_article', '!=', $this->articles->id_dissertation_article)->orderBy('created_at', 'desc')->paginate(4);
        return view('livewire.thesis.detail-thesis-login', ['other_articles' => $other_articles]);
    }
}
