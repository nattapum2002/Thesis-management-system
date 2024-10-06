<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class ApproveNews extends Component
{
    use WithPagination;

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

    public function render()
    {
        $news = News::with('teacher')
            ->whereHas('teacher', function ($query) {
                $query->where('user_type', '!=', 'Admin');
            })
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
            ->paginate(15);
        $types = News::select('type')->distinct()->get();

        return view('livewire.news.approve-news', ['news' => $news, 'types' => $types]);
    }
}
