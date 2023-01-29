<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mark = null;

    #[ORM\Column(length: 255)]
    private ?string $shoesname = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: ShoesGender::class, inversedBy: 'products')]
    private Collection $gendershoes;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ShoesCategory $category = null;

    #[ORM\Column(nullable: true)]
    private ?int $promotion = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Remarks::class)]
    private Collection $remarks;

    #[ORM\Column(nullable: true)]
    private ?bool $isBest = null;

    #[ORM\ManyToMany(targetEntity: AdultSize::class, inversedBy: 'products')]
    private Collection $adultsize;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Wishlist::class, orphanRemoval: true)]
    private Collection $wishlists;


    public function __construct()
    {
        $this->gendershoes = new ArrayCollection();
        $this->remarks = new ArrayCollection();
        $this->adultsize = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getShoesname(): ?string
    {
        return $this->shoesname;
    }

    public function setShoesname(string $shoesname): self
    {
        $this->shoesname = $shoesname;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, ShoesGender>
     */
    public function getGendershoes(): Collection
    {
        return $this->gendershoes;
    }

    public function addGendershoe(ShoesGender $gendershoe): self
    {
        if (!$this->gendershoes->contains($gendershoe)) {
            $this->gendershoes->add($gendershoe);
        }

        return $this;
    }

    public function removeGendershoe(ShoesGender $gendershoe): self
    {
        $this->gendershoes->removeElement($gendershoe);

        return $this;
    }

    public function getCategory(): ?ShoesCategory
    {
        return $this->category;
    }

    public function setCategory(?ShoesCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPromotion(): ?int
    {
        return $this->promotion;
    }

    public function setPromotion(?int $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function discountPrice()
    {
        $newprice = $this->getPrice() - ($this->getPrice() * $this->getPromotion() / 100);
        
        return $newprice;
    }

    /**
     * @return Collection<int, Remarks>
     */
    public function getRemarks(): Collection
    {
        return $this->remarks;
    }

    public function addRemark(Remarks $remark): self
    {
        if (!$this->remarks->contains($remark)) {
            $this->remarks->add($remark);
            $remark->setProduct($this);
        }

        return $this;
    }

    public function removeRemark(Remarks $remark): self
    {
        if ($this->remarks->removeElement($remark)) {
            // set the owning side to null (unless already changed)
            if ($remark->getProduct() === $this) {
                $remark->setProduct(null);
            }
        }

        return $this;
    }

    public function isIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(?bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    /**
     * @return Collection<int, AdultSize>
     */
    public function getAdultsize(): Collection
    {
        return $this->adultsize;
    }

    public function addAdultsize(AdultSize $adultsize): self
    {
        if (!$this->adultsize->contains($adultsize)) {
            $this->adultsize->add($adultsize);
        }

        return $this;
    }

    public function removeAdultsize(AdultSize $adultsize): self
    {
        $this->adultsize->removeElement($adultsize);

        return $this;
    }

    /**
     * @return Collection<int, Wishlist>
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(Wishlist $wishlist): self
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
            $wishlist->setProduct($this);
        }

        return $this;
    }

    public function removeWishlist(Wishlist $wishlist): self
    {
        if ($this->wishlists->removeElement($wishlist)) {
            // set the owning side to null (unless already changed)
            if ($wishlist->getProduct() === $this) {
                $wishlist->setProduct(null);
            }
        }

        return $this;
    }

    //this shows the products the user has wished
    public function isWishedByUser(User $user): bool
    {
        //the foreach loops through all the products which the user has wished
        foreach ($this->wishlists as $wishlist) {
            if($wishlist->getUser() === $user)
            return true;
        }

        return false;
    }

}
