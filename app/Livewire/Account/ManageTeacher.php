<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\WithPagination;

class ManageTeacher extends Component
{
    use WithPagination;

    public $search = '';
    public $editingId;
    public $editingVar;

    public function render()
    {
        $teachers = Teacher::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->paginate(15);

        return view('livewire.account.manage-teacher', ['teachers' => $teachers]);
    }
}
