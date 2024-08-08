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
            })->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
        $types = News::select('type')->distinct()->get();

        return view('livewire.news.approve-news', ['news' => $news, 'types' => $types]);
    }
}