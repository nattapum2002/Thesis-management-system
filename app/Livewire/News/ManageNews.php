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
    public $filterDate = 'ข่าวล่าสุด';
    public $filterType = 'ทุกประเภท';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'ข่าวล่าสุด'],
        'filterType' => ['except' => 'ทุกประเภท']
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
            ->when($this->filterType != 'ทุกประเภท', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterDate == 'ข่าวเก่าสุด', function ($query) {
                $query->orderBy('created_at', 'asc');
            })
            ->when($this->filterDate == 'ข่าวล่าสุด', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(15);

        return view('livewire.news.manage-news', ['news' => $news]);
    }
}
