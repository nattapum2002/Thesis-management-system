<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dissertation_article;

class ThesisDetail extends Component
{
    public $article;

    public function mount($id)
    {
        $this->article = Dissertation_article::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.thesis-detail', ['article' => $this->article]);
    }
}
