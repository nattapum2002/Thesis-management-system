<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;

class DetailNews extends Component
{
    public $news;

    public function mount($id)
    {
        $this->news = News::with('teacher')->find($id);
    }

    public function render()
    {
        $other_news = News::where('id_news', '!=', $this->news->id_news)->orderBy('created_at', 'desc')->paginate(4);
        return view('livewire.news.detail-news', ['other_news' => $other_news]);
    }
}