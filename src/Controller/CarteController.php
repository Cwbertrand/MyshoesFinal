<?php

namespace App\Controller;

use App\Class\Carte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/mon_carte', name: 'carte')]
    public function index(Carte $carte): Response
    {
        $carte->getCarte();
        
        return $this->render('carte/index.html.twig', [
            'cartes' => $carte->productDetails(),
        ]);
    }

    //Add product in the carte
    #[Route('/carte/add/{id}', name: 'add_my_carte')]
    public function addCarte(Carte $carte, $id): Response
    {
        $carte->addCarte($id);

        return $this->redirectToRoute('carte');
    }

    //Minus product in the carte
    #[Route('/carte/minus/{id}', name: 'minus_my_carte')]
    public function minusCarte(Carte $carte, $id): Response
    {
        $carte->minusCarte($id);

        return $this->redirectToRoute('carte');
    }

    //delete product in the carte
    #[Route('/carte/delete/{id}', name: 'delete_from_carte')]
    public function deleteCarte(Carte $carte, $id): Response
    {
        $carte->deleteProduct($id);

        return $this->redirectToRoute('carte');
    }
    //Remove product in the carte
    #[Route('/carte/remove', name: 'remove_from_carte')]
    public function removeCarte(Carte $carte): Response
    {
        $carte->removeCarte();

        return $this->redirectToRoute('men');
    }
}