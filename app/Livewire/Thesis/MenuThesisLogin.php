<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\Project;
use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MenuThesisLogin extends Component
{
    use WithPagination;

    public $users;
    public $search = '';
    public $filterDate = 'desc';
    public $filterType = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'desc'],
        'filterType' => ['except' => 'all'],
    ];

    public function mount()
    {
        if (Auth::guard('teachers')->check()) {
            $this->users = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        }
        if (Auth::guard('members')->check()) {
            $this->users = Member::find(Auth::guard('members')->user()->id_student);
        }
    }

    public function render()
    {
        $projects = Project::with('members')->get();
        $articles = Dissertation_article::with('project')->where('status', 1)
            ->when($this->search, function ($query) {
                $query->where('dissertation_articles.title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->where('dissertation_articles.type', $this->filterType);
            })
            ->orderBy('dissertation_articles.created_at', $this->filterDate)
            ->paginate(8);
        $types = Dissertation_article::select('type')->where('status', '1')->distinct()->get();

        return view('livewire.thesis.menu-thesis-login', ['articles' => $articles, 'projects' => $projects, 'types' => $types]);
    }
}
