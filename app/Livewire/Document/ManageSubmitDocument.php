<?php

namespace App\Livewire\Document;

use App\Models\Document;
use Livewire\Component;

class ManageSubmitDocument extends Component
{
    public $documents;
    public function mount(){
        $this->documents = Document::all();
    }
    public function render()
    {
        
        return view('livewire.document.manage-submit-document');
    }
}
