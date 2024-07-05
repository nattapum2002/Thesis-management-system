<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;

class DetailNews extends Component
{
    public $news;

    public function mount($id)
    {
        $this->news = News::with('teacher')->find($id);
    }

    public function render()
    {
        return view('livewire.news.detail-news', ['news' => $this->news]);
    }
}