<?php

namespace App\Twig\Runtime;

use Twig\TwigFunction;
use App\Entity\Wishlist;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\RuntimeExtensionInterface;

class WishlistExtensionRuntime implements RuntimeExtensionInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function wishlistTotal(): int
        {
            $wishlist = $this->em->getRepository(Wishlist::class)->findAll();
            $wishlistTotal = count($wishlist);
            return $wishlistTotal;
        }
}
