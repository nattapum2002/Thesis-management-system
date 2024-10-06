<?php

namespace App\Livewire\News;

use App\Models\Member;
use Livewire\Component;
use App\Models\News;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MenuNewsLogin extends Component
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
        $news = News::with('teacher')->where('status', 1)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->orderBy('created_at', $this->filterDate)
            ->paginate(8);
        $types = News::select('type')->distinct()->get();

        return view('livewire.news.menu-news-login', ['news' => $news, 'types' => $types]);
    }
}
