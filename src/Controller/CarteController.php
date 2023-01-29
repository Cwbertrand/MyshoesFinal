<?php

namespace App\Controller;

use App\Class\Carte;
use App\Entity\Product;
use App\Entity\AdultSize;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
    public function index(Carte $carte): Response
    {
        $carte->getCarte();
        
        return $this->render('carte/index.html.twig', [
            'cartes' => $carte->productDetails(),
        ]);
    }

    //Add shoes size
    // #[ParamConverter('product', options: ['mapping' => ['idproduct' => 'id']])]
    // #[ParamConverter('adultsize', options: ['mapping' => ['id' => 'id']])]
    #[Route('/carte/add/size/{id}', name: 'product_size')]
    public function productSize($idadultsize, Product $product = null, Carte $carte): Response
    {
        $return = false;


        if ($product) {

            $sizeid = $this->em->getRepository(AdultSize::class)->findOneById($idadultsize);
            
            if ($sizeid && $this->session->get('carte') !== null){
                $carte = $this->session->get('carte');
                $carte['adultsize'] = $sizeid->getAdultsize();
                $this->session->set('carte', $carte);
                

                $return = dd($carte['adultsize']);
            }

            dd();
            
        }

        return new JsonResponse($return);

        
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
