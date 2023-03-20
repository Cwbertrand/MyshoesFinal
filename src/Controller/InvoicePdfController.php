<?php

namespace App\Controller;

use App\Service\InvoicePdf;
use App\Entity\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdfController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/client/command/invoice/pdf/{reference}', name: 'invoice_pdf')]
    public function invoicePdf($reference, InvoicePdf $invoicePdf): Response
    {

        //This get the command that is referenced to this particular command
        $commanddetail = $this->em->getRepository(Command::class)->findOneByReference($reference);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('account/invoicepdf.html.twig', [
            'commanddetail' => $commanddetail,
        ]);

        //this calls the function created in invoicepdf class
        return $invoicePdf->showPdf($html);
    }
}