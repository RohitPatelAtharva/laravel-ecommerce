<?php
// use Barryvdh\DomPDF\PDF;
namespace App\Http\Controllers;
// use PDF;
use Barryvdh\DomPDF\PDF;


class PDFController extends Controller
{
    public function generatePDF()
    {
        
     
     $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y')
    ];
      
    $pdf = PDF::loadView('admin.invoice.invoiceBill', $data);

    return $pdf->download('itsolutionstuff.pdf');
}
}

