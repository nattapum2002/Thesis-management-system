<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMember extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    { 
        return view('livewire.manage-member',['data' => Member::paginate(5),]);
    }
}
