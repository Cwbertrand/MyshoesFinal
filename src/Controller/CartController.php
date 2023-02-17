<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @var CartService
     */
    private $cartservice;


    public function __construct(CartService $cartservice)
    {
        $this->cartservice = $cartservice;
    }

    #[Route('/my_cart', name: 'cart')]
    public function index(CartService $cartservice): Response
    {
        $cartItems = $this->cartservice->getCart();
        return $this->render('cart/index.html.twig', [
            'carts' => $cartItems,
        ]);
    }

    //Add product in the cart
    #[Route('/add-to-cart/{id}', name: 'add_to_cart')]
    public function addCartQuantity($id, Request $request): Response
    {
        // Get the size ID from the request object
        $sizeId = $request->request->get('size');
        $this->cartservice->addToCart($id, $sizeId);

        return $this->redirectToRoute('cart');
    }

    //Updating the quantity
    #[Route('/cart/update/{cartKey}', name: 'update_cart')]
    public function updateCart(Request $request, $cartKey)
    {
        $action = $request->query->get('action');
        $this->cartservice->updateCart($cartKey, $action);

        return $this->redirectToRoute('cart');
    }

    // Delete product from the cart
    #[Route('/cart/delete/{id}', name: 'delete_from_cart')]
    public function deleteCart($id): Response
    {
        $this->cartservice->deleteCart($id);
        return $this->redirectToRoute('cart');
    }

}
