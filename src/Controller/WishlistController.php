<?php

namespace App\Controller;

use DateTime;
use App\Entity\Product;
use App\Entity\Wishlist;
use App\Repository\WishlistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WishlistController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/wishlist', name: 'wishlist')]
    public function index(): Response
    {
        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
        ]);
    }

    //When you click on the wishlist button, this is what that happens
    #[Route('/add/product/to/wishlist/{id}', name: 'add_wishlist')]
    public function addWishlist(Product $product)
    {
        $user = $this->getUser();

        //if the user does not exist
        if(!$user){
            return new JsonResponse([
                'code' => 403,
                'message' => 'Please sign in',
            ], 403);
        }

        //this removes the products from the wishlist
        if($product->isWishedByUser($user)){
            $wishlist = $this->em->getRepository(Wishlist::class)->findOneBy(['product' => $product, 'user' => $user]);
            $this->em->remove($wishlist);
            $this->em->flush();

            return new JsonResponse([
                'code' => 200,
                'message' => 'Product has successfully been removed',
            ], 200);
        }

        $wishlist = new Wishlist();
        $date = new DateTime();

        $wishlist->setproduct($product);
        $wishlist->setUser($user);
        $wishlist->setCreateAt($date);
        
        $this->em->persist($wishlist);
        $this->em->flush();

        return new JsonResponse([
            'code' => 200,
            'message' => 'Yor product has been added successfully',
            //'totalwishlist' => count($product),
        ], 200);
    }
}
