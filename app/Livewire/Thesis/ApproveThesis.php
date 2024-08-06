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
            })
            ->paginate(15);

        return view('livewire.thesis.approve-thesis', ['thesis' => $thesis]);
    }
}