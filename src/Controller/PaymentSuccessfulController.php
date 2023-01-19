<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentSuccessfulController extends AbstractController
{
    #[Route("/payment/successful/{Stripesessionid}", name: 'app_payment_successful')]
    public function index(): Response
    {
        return $this->render('payment_successful/index.html.twig', [
            'controller_name' => 'PaymentSuccessfulController',
        ]);
    }
}
