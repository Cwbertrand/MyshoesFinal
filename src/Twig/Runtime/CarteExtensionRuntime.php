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
        $carte = $this->session->getSession()->get('carte', []);
        $totalQuantity = 0;
        foreach ($carte as $item) {
            $totalQuantity += $item['quantity'];
        }
        return $totalQuantity;
    }
}
