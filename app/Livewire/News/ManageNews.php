<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ManageNews extends Component
{
    use WithPagination;

    public $users;
    public $search = '';
    public $filterType = 'all';
    public $filterApprove = 'all';
    public $sortField = 'id_news';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => 'all'],
    ];

    public function show($index)
    {
        News::where('id_news', $index)->update([
            'status' => '0'
        ]);
        session()->flash('danger', 'ซ่อนข่าว ' . News::find($index)->title .  ' เรียบร้อยแล้ว');
    }
    public function hide($index)
    {
        News::where('id_news', $index)->update([
            'status' => '1'
        ]);
        session()->flash('success', 'แสดงข่าว ' . News::find($index)->title .  ' เรียบร้อยแล้ว');
    }

    public function mount()
    {
        if (Auth::guard('teachers')->check()) {
            $this->users = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        }
    }

    public function render()
    {
        $news = News::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterApprove != 'all', function ($query) {
                $query->where('status', $this->filterApprove);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        $types = News::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->select('type')->distinct()->get();

        return view('livewire.news.manage-news', ['news' => $news, 'types' => $types]);
    }
}
