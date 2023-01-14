<?php

namespace App\Controller;

use App\Class\Search;
use App\Entity\Product;
use App\Form\SearchType;
use App\Entity\ShoesGender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/men', name: 'men')]
    public function index(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->findWithSearch($search);

            return $this->render('men/index.html.twig', [
                'products' => $search,
                'form' => $form->createView(),
            ]);
        }

         //Query to select all men's shoes
        $men = $this->em->getRepository(ShoesGender::class)->find(1);   // the find(1) gets the id of ShoesGender

        return $this->render('men/index.html.twig', [
            // c'est la methode qui fait la relation MAnytoMany
            'products' => $men->getProducts(),//->toArray(),
            'form' => $form->createView(),
        ]);
    }

    //Show product details
    #[Route('/men/product/detail/{slug}', name: 'detail_men_product')]
    public function productDetail(Product $product): Response
    {
        return $this->render('men/showmen.html.twig', [
            'detailproduct' => $product,
        ]);
    }
}
