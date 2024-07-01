<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class MenuNews extends Component
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
            ->paginate(15);

        return view('livewire.news.menu-news', ['news' => $news]);
    }
}