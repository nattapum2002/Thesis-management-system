<?php

namespace App\Livewire\DocumentDetail;

use Livewire\Component;

class Document07 extends Component
{
    public $id_project, $id_document;
    public function mount($id_project, $id_document)
    {
        $this->id_project = $id_project;
        $this->id_document = $id_document;
    }
    public function render()
    {
        return view('livewire.document-detail.document07');
    }
}
