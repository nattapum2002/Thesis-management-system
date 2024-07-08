<?php

namespace App\Livewire\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Test extends Component
{
    public $name;
    public $email;

    public function generatePDF()
    {
        // เพิ่มเวลาสูงสุดในการประมวลผล
        set_time_limit(30); // 300 วินาที

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        $pdf = PDF::loadView('pdf.document', $data);
        $pdf->setPaper('a4', 'portrait');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'document.pdf');
    }

    public function render()
    {
        return view('livewire.pdf.test');
    }
}