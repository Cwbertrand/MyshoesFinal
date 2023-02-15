<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(RequestStack $requestStack): Response
    {

        $session = $requestStack->getSession();
        $qty = $session->get('carte', []);

        $totalqty = array_sum($qty);
        $bestpromotion = $this->em->getRepository(Product::class)->findByisBest(1);
        $header = $this->em->getRepository(Header::class)->findByisPublish(1);
        //dd($header);
        return $this->render('home/index.html.twig', [
            'products' => $bestpromotion,
            'carousels' => $header,
        ]);
    }
}
