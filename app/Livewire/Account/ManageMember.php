<?php

namespace App\Livewire\Account;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMember extends Component
{
    use WithPagination;

    public $search = '';
    public $editingId;
    public $editingVar;

    public function render()
    {
        $members = Member::with('course', 'level')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->paginate(15);

        return view('livewire.account.manage-member', ['members' => $members]);
    }
}
