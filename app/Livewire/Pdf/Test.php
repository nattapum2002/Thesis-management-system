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
        // $pdf = App::make('dompdf.wrapper');
        // $html = view('pdf.document')->render();
        // $pdf->loadHTML($html);
        // return $pdf->stream();
        // เพิ่มเวลาสูงสุดในการประมวลผล
        // set_time_limit(300); // 300 วินาที

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
