<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\WithPagination;

class ManageTeacher extends Component
{
    use WithPagination;

    public $search = '';
    public $teachers;
    public $editingId;
    public $editingVar;

    public function delete()
    {
    }

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
        $this->teachers = Teacher::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.admin.manage-teacher');
    }
}