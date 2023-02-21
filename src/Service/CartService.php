<?php

namespace App\Service;

use App\Entity\AdultSize;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class CartService
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

    // A private helper function that generates a unique cart key based on the product and size IDs
    private function generate_cart_key($id, $sizeId) {
        return $id . '_' . $sizeId;
    }

    //this adds the product into the shopping cart
    public function addToCart($id, $sizeId){
        // Retrieve the product and size objects from the database using their IDs
        $product = $this->em->getRepository(Product::class)->find($id);
        $size = $this->em->getRepository(AdultSize::class)->find($sizeId);

        // Retrieve the current cart from the session, or initialize an empty carte if it doesn't exist yet
        $cart = $this->session->get('cart', []);

        // Generate a unique key for the carte item based on the product and size IDs
        $cartKey = $this->generate_cart_key($id, $sizeId);

        if(isset($cart[$cartKey])){
            $cart[$cartKey]['quantity'] += 1;
        }else if(isset($cart[$id])) {
            // If a cart item with the specified product ID exists, create a new cart item with the specified size and a quantity of 1
            $cart[$this->generate_cart_key($id, $sizeId)] = [
                'productdetail' => $product,
                'size' => $size,
                'quantity' => 1
            ];
        }else{
             // If a cart item with the same product and size does not exist, create a new cart item
            $cart[$cartKey] = [
                'productdetail' => $product,
                'size' => $size,
                'quantity' => 1
            ];
        }

        // Save the updated cart back to the session
        $cart = $this->session->set('cart', $cart);
    }

    //this updates the quantity of the product
    public function updateCart($cartKey, $action){
        if($action && ($action === 'add' || $action === 'minus')){
            $cart = $this->session->get('cart', []);

            //declaring a default flag to false (assuming that no updates have been made)
            $updated = false;

            foreach ($cart as $cartItemKey => $cartItem) {
                if ($cartItem['productdetail']->getId() === intval($cartKey)) {
                    //adds the quantity if the action is strictly 'add' if not, the quantity is minus
                    if ($action === 'add') {
                        $cart[$cartItemKey]['quantity'] += 1;
                    } elseif ($action === 'minus') {
                        if ($cart[$cartItemKey]['quantity'] > 1) {
                            $cart[$cartItemKey]['quantity'] -= 1;
                        } else {
                            unset($cart[$cartItemKey]);
                        }
                    }
                    // Set the flag to indicate that the update has been made
                    $updated = true;
                }
                // Check the flag to see if the update has been made, and exit the loop if it has
                if ($updated) {
                    break;
                }
            }
            $this->session->set('cart', $cart);
        }
    }

    //Deleting product from cart
    public function deleteCart($id){
        $cart = $this->session->get('cart', []);
        foreach ($cart as $cartItemKey => $cartItem){
            if($cartItem['productdetail']->getId() === intval($id)){
                unset($cart[$cartItemKey]);

                 // Exit the loop early since we've already found and removed the matching cart item
                break;
            }
        }
        $this->session->set('cart', $cart);
    }

    //Clearing everything in the cart
    public function removeCart(){
        return $this->session->remove('cart');
    }


    //Getting the entire cart array (product, quantity and size)
    public function getCart() {
        return $this->session->get('cart', []);
    }




}