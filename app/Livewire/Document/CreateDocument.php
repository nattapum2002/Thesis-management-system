<?php

namespace App\Livewire\Document;

use Livewire\Component;

class CreateDocument extends Component
{
    public $member1 ,$member2 ,$member3 ,$member4 ;

    public function  create_document(){
        dd($this->member1);
    }
    public function render()
    {
        return view('livewire.document.create-document');
    }
}
