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
    public $filterDate = 'ข่าวล่าสุด';
    public $filterType = 'ทุกประเภท';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'ข่าวล่าสุด'],
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
        $news = News::with('teacher')->where('status', 1)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'ทุกประเภท', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterDate == 'ข่าวเก่าสุด', function ($query) {
                $query->orderBy('created_at', 'asc');
            })
            ->when($this->filterDate == 'ข่าวล่าสุด', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(8);

        return view('livewire.news.menu-news-login', ['news' => $news]);
    }
}
