<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMember extends Component
{
    use WithPagination;

    public $search = '';
    public $members;
    public $editingId;
    public $editingVar;

    public function mount()
    {
        //$this->teachers = Teacher::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->members = Member::with('course', 'level')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.account.manage-member');
    }
}
