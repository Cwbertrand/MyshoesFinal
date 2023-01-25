<?php

namespace App\Class;

use Dompdf\Dompdf;
use Dompdf\Options;

class InvoicePdf
{
    private $dompdf;

    public function __construct()
    {
        // instantiate and use the dompdf class
        $this->dompdf = new Dompdf();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $this->dompdf->setOptions($pdfOptions);
    }

    public function showPdf($html){
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();
        $this->dompdf->stream('invoice.php', [
            'Attachment' => false,
        ]);
    }

    public function generatePdfEmail($html){
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();
        $this->dompdf->output();
    }


}