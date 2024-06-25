<?php

namespace App\Livewire\DocumentLayout;

use Livewire\Component;
use App\Models\Teacher;

class Doc01AdvisersInput extends Component
{
    public $selectedAdvisor;
    public $selectedCoAdvisors = [];
    public $externalCoAdvisors = [];

    public function render()
    {
        $advisors = Teacher::all();
        $coAdvisors = Teacher::all();

        return view('livewire.document-layout.doc01-advisers-input', [
            'advisors' => $advisors,
            'coAdvisors' => $coAdvisors
        ]);
    }

    public function addCoAdvisor()
    {
        if ($this->totalCoAdvisors() < 3) {
            $this->selectedCoAdvisors[] = '';
        }
    }

    public function updateCoAdvisor($index, $value)
    {
        $this->selectedCoAdvisors[$index] = $value;
    }

    public function removeCoAdvisor($index)
    {
        unset($this->selectedCoAdvisors[$index]);
        $this->selectedCoAdvisors = array_values($this->selectedCoAdvisors);
    }

    public function addExternalCoAdvisor()
    {
        if ($this->totalCoAdvisors() < 3) {
            $this->externalCoAdvisors[] = [
                'prefix' => '',
                'name' => '',
                'surname' => '',
                'academic_position' => '',
                'education_degree' => '',
                'graduated_major' => '',
            ];
        }
    }

    public function removeExternalCoAdvisor($index)
    {
        unset($this->externalCoAdvisors[$index]);
        $this->externalCoAdvisors = array_values($this->externalCoAdvisors);
    }

    public function totalCoAdvisors()
    {
        return count($this->selectedCoAdvisors) + count($this->externalCoAdvisors);
    }

    public function saveExternalCoAdvisors()
    {
        // Logic for saving external co-advisors
    }
}