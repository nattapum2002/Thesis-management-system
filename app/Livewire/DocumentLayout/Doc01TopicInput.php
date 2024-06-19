<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;

class Doc01TopicInput extends Component
{
    public $projectNameThai;
    public $projectNameEnglish;

    public function render()
    {
        return view('livewire.document-layout.doc01-topic-input');
    }
}