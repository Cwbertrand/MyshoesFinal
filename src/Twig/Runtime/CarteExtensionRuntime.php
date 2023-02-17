<?php

namespace App\Twig\Runtime;

use Twig\TwigFunction;
use Twig\Extension\RuntimeExtensionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CarteExtensionRuntime implements RuntimeExtensionInterface
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack;
    }

    //This function retrieves the total quantity of products in the shopping cart
    public function totalQuantity(): int
    {
        $cart = $this->session->getSession()->get('cart', []);
        $totalQuantity = 0;
        foreach ($cart as $item) {
            if (isset($item['quantity'])) {
                $totalQuantity += $item['quantity'];
            }
        }
        return $totalQuantity;
    }
}
