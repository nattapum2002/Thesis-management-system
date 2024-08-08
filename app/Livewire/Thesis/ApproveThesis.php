<?php

namespace App\Livewire\Thesis;

use Livewire\Component;
use App\Models\Dissertation_article;
use Livewire\WithPagination;

class ApproveThesis extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = 'ข่าวล่าสุด';
    public $filterType = 'ทุกประเภท';
    public $sortField = 'id_dissertation_article';
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
        Dissertation_article::where('id_dissertation_article', $index)->update([
            'status' => '0'
        ]);
        session()->flash('danger', 'ซ่อนบทความ ' . Dissertation_article::find($index)->title .  ' เรียบร้อยแล้ว');
    }
    public function hide($index)
    {
        Dissertation_article::where('id_dissertation_article', $index)->update([
            'status' => '1'
        ]);
        session()->flash('success', 'แสดงบทความ ' . Dissertation_article::find($index)->title .  ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $thesis = Dissertation_article::query()
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
        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.approve-thesis', ['thesis' => $thesis, 'types' => $types]);
    }
}