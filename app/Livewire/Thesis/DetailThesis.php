<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use Livewire\Component;

class DetailThesis extends Component
{
    public $article;

    public function mount($id)
    {
        $this->article = Dissertation_article::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.thesis.detail-thesis');
    }
}
