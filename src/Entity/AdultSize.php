<?php

namespace App\Entity;

use App\Repository\AdultSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdultSizeRepository::class)]
class AdultSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $adultsize = null;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'adultsize')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdultsize(): ?float
    {
        return $this->adultsize;
    }

    public function __toString()
    {
        return $this->getAdultsize();
    }

    public function setAdultsize(float $adultsize): self
    {
        $this->adultsize = $adultsize;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addAdultsize($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeAdultsize($this);
        }

        return $this;
    }

}
