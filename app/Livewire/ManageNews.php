<?php

namespace App\Livewire;

use Livewire\Component;
class ManageNews extends Component
{
    public $title , $detail , $status , $type ;
    public function addNews(){
        dd($this->title);
    }
    public function render()
    {
        return view('livewire.manage-news');
    }
}
