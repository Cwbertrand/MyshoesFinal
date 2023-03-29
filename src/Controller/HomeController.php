<?php

namespace App\Controller;

use App\Entity\Header;
use App\Service\Email;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {

        $bestpromotion = $this->em->getRepository(Product::class)->findByisBest(1);
        $header = $this->em->getRepository(Header::class)->findByisPublish(1);
        //dd($header);
        return $this->render('home/index.html.twig', [
            'products' => $bestpromotion,
            'carousels' => $header,
        ]);
    }

    #[Route('/newsletter', name: 'newsletter')]
    public function newsletter(Request $request): Response
    {
        if($request->request->get('email')){
            $user = new User();
            $mailer = new Email();
            $content = ' Thanks so much for reaching us. We will get back to you as soon as possible';
            $mailer->sendEmail($user->getEmail(), $user->getEmail(), $contactUs->getSubject(), $content);
            
            return $this->redirectToRoute('contact_us');
        }
        dd($request);
        return $this->render('home/index.html.twig', [
        ]);
    }
}
