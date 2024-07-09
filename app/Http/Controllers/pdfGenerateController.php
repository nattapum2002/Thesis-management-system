<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class pdfGenerateController extends Controller
{
    public function generate()
    {
        $pdf = App::make('dompdf.wrapper');
        $html = view('pdf.document')->render();
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}