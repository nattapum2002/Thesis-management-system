<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class MenuNews extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = 'desc';
    public $filterType = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'desc'],
        'filterType' => ['except' => 'all'],
    ];

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
            ->paginate(8)->appends(request()->query());

        $types = News::select('type')->distinct()->get();

        return view('livewire.news.menu-news', ['news' => $news, 'types' => $types]);
    }
}
