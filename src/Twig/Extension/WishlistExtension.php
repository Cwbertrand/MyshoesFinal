<?php

namespace App\Twig\Extension;

use App\Entity\Wishlist;
use App\Twig\Runtime\WishlistExtensionRuntime;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class WishlistExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('wishlist_total_quantity', [WishlistExtensionRuntime::class, 'wishlistTotal']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('wishlist_total_quantity', [WishlistExtensionRuntime::class, 'wishlistTotal']),
        ];
    }

        public function wishlistTotal(): int
        {
            $wishlist = $this->em->getRepository(Wishlist::class)->findAll();
            $wishlistTotal = count($wishlist);
            return $wishlistTotal;
        }
}
