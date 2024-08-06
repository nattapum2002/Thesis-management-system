<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class ApproveNews extends Component
{
    use WithPagination;

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

    public function render()
    {
        $news = News::with('teacher')
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

        return view('livewire.news.approve-news', ['news' => $news]);
    }
}
