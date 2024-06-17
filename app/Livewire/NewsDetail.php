<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsDetail extends Component
{
    public $newsId;
    public $news;

    public function mount($id)
    {
        $this->newsId = $id;
        // Load news along with the related teacher
        $this->news = News::with('teacher')->find($id);
    }

    public function render()
    {
        return view('livewire.news-detail', ['news' => $this->news]);
    }
}
