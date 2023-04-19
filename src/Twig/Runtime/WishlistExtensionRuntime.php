<?php

namespace App\Twig\Runtime;

use App\Entity\User;
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

    public function wishlistTotal(?User $user = null): int
        {
            //$wishlist = $this->em->getRepository(Wishlist::class)->findBy(['user' => $user]);
           // $wishlistTotal = count($wishlist);
            //return $wishlistTotal;
            return $user === null? 0 : count($this->em->getRepository(Wishlist::class)->findBy(['user' => $user]));
            
        }
}
