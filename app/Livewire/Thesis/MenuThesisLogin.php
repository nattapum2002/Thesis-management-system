<?php

namespace App\Livewire\thesis;

use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\Project;
use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MenuthesisLogin extends Component
{
    use WithPagination;

    public $users;
    public $search = '';
    public $filterDate = 'บทความล่าสุด';
    public $filterType = 'ทุกประเภท';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'บทความล่าสุด'],
        'filterType' => ['except' => 'ทุกประเภท']
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
            ->when($this->filterType != 'ทุกประเภท', function ($query) {
                $query->where('dissertation_articles.type', $this->filterType);
            })
            ->when($this->filterDate == 'บทความเก่าสุด', function ($query) {
                $query->orderBy('dissertation_articles.created_at', 'asc');
            })
            ->when($this->filterDate == 'บทความล่าสุด', function ($query) {
                $query->orderBy('dissertation_articles.created_at', 'desc');
            })
            ->paginate(8);
        $types = Dissertation_article::select('type')->where('status', '1')->distinct()->get();

        return view('livewire.thesis.menu-thesis-login', ['articles' => $articles, 'projects' => $projects, 'types' => $types]);
    }
}