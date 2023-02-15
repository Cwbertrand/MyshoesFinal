<?php

namespace App\Twig\Extension;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use App\Twig\Runtime\CarteExtensionRuntime;
use Symfony\Component\HttpFoundation\RequestStack;

class CarteExtension extends AbstractExtension
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack;
    }
    
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('carte_total_quantity', [CarteExtensionRuntime::class, 'totalQuantity']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('carte_total_quantity', [CarteExtensionRuntime::class, 'totalQuantity']),
        ];
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
