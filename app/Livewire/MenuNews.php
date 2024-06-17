<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;

class MenuNews extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = 'latest';
    public $filterType = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'latest'],
        'filterType' => ['except' => 'all']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterDate()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $news = News::with('teacher')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
                dd($this->search);
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->where('type', $this->filterType);
                dd($this->filterType);
            })
            ->when($this->filterDate == 'oldest', function ($query) {
                $query->orderBy('created_at', 'asc');
            })
            ->when($this->filterDate == 'latest', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(8);

        return view('livewire.menu-news', ['news' => $news]);
    }
}
