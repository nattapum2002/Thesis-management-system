<?php

namespace App\Livewire\Thesis;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dissertation_article;

class MenuThesis extends Component
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

    public function render()
    {
        $articles = Dissertation_article::where('status', 1)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterType != 'all', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterDate == 'oldest', function ($query) {
                $query->orderBy('created_at', 'asc');
            })
            ->when($this->filterDate == 'latest', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(8);
        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.menu-thesis', ['articles' => $articles, 'types' => $types]);
    }
}