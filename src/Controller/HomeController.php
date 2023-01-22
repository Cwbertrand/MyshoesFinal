<?php

namespace App\Controller;

use App\Class\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // $email = new Email();
        // //dd($email);
        // $email->sendEmail(toEmail: 'chuwung49@yahoo.com', toClient: 'John Doe', subject: 'My first Message', content: 'Good morning, I hope your okay');
        // //dd($email);
        return $this->render('home/index.html.twig', [
        ]);
    }
}
