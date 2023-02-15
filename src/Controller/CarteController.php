<?php

namespace App\Controller;

use App\Class\Carte;
use App\Entity\Product;
use App\Entity\AdultSize;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController
{
    private $em;

    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->session = $requestStack->getSession();
    }

    #[Route('/mon_carte', name: 'carte')]
    public function index(): Response
    {
        return $this->render('carte/index.html.twig', [
            'cartes' => $this->session->get('carte', [])
        ]);
    }

    //This function retrieves the total quantity of products in the shopping carte
    public function totalQuantity(): int
    {
        $carte = $this->session->get('carte', []);

        $qty = $carte['quantity'];
        return array_sum($qty);
    }

    //Add product in the carte
    #[Route('/add-to-carte/{id}', name: 'add_my_carte')]
    public function addCarte($id, Request $request): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        //data collected from the ajax function
        $selectedSize = $request->get('size');
        //storing data into the session
        $request->getSession()->set('selected_size', $selectedSize);

        if(!$product){
            //handle error.
        }


        $carte = $this->session->get('carte', []);
        if (isset($carte[$id])) {
            $carte[$id]['quantity']++;
        } else {
            $carte[$id] = [
                'productdetail' => $product,
                'selectedsize' => $selectedSize,
                'quantity' => 1,
            ];
        }
        $this->session->set('carte', $carte);
        
        return $this->redirectToRoute('carte');
    }

    //Minus product in the carte
    #[Route('/minus-to-carte/{id}', name: 'minus_my_carte')]
    public function minusCarte($id): Response
    {
        $carte = $this->session->get('carte', []);

        if(isset($carte[$id]) && $carte[$id]['quantity'] > 1){
            $carte[$id]['quantity']--;
        }else{
            unset($carte[$id]);
        }

        $this->session->set('carte', $carte);
        return $this->redirectToRoute('carte');
    }

    //delete product in the carte
    #[Route('/carte/delete/{id}', name: 'delete_from_carte')]
    public function deleteCarte($id): Response
    {
        $carte = $this->session->get('carte', []);

        unset($carte[$id]);

        $this->session->set('carte', $carte);
        return $this->redirectToRoute('carte');
    }
    
    // //Remove product in the carte
    // #[Route('/carte/remove', name: 'remove_from_carte')]
    // public function removeCarte(): Response
    // {
    //    $carte = $this->session->get('carte', []);
    //     $this->session->remove('carte');
    //    $this->session->set('carte', $carte);
    //     return $this->redirectToRoute('men');
    // }

}
