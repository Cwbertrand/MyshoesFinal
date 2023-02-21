<?php

namespace App\Class;

use Dompdf\Dompdf;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdf
{
    private $dompdf;

    public function __construct()
    {
        // instantiate and use the dompdf class
        $this->dompdf = new Dompdf();
    }

    public function showPdf($html): Response
    {
        // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();

        // Output the generated PDF to Browser
        $this->dompdf->stream('invoice.pdf', [
            'Attachment' => false,
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

        //generating a pdf invoice to send by email
    // public function generatePdfEmail($html){
    //     $this->dompdf->loadHtml($html);
    //     $this->dompdf->render();
    //     $this->dompdf->output();
    // }


}