<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;

class DetailNewsLogin extends Component
{
    public $news;

    public function mount($id)
    {
        $this->news = News::with('teacher')->find($id);
    }

    public function render()
    {
        return view('livewire.news.detail-news-login', ['news' => $this->news]);
    }
}