<?php

namespace App\Entity;

use App\Repository\CommandDetailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandDetailRepository::class)]
class CommandDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $productname = null;

    #[ORM\Column]
    private ?int $productprice = null;

    #[ORM\Column(length: 255)]
    private ?string $productimage = null;

    #[ORM\Column]
    private ?float $commandtotal = null;

    #[ORM\Column(length: 255)]
    private ?string $productmark = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $productdescription = null;

    #[ORM\ManyToOne(inversedBy: 'commandDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Command $command = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function __toString()
    {
        return $this->getProductname();
    }

    public function getProductprice(): ?int
    {
        return $this->productprice;
    }

    public function setProductprice(int $productprice): self
    {
        $this->productprice = $productprice;

        return $this;
    }

    public function getProductimage(): ?string
    {
        return $this->productimage;
    }

    public function setProductimage(string $productimage): self
    {
        $this->productimage = $productimage;

        return $this;
    }

    public function getCommandtotal(): ?float
    {
        return $this->commandtotal;
    }

    public function setCommandtotal(float $commandtotal): self
    {
        $this->commandtotal = $commandtotal;

        return $this;
    }

    public function getProductmark(): ?string
    {
        return $this->productmark;
    }

    public function setProductmark(string $productmark): self
    {
        $this->productmark = $productmark;

        return $this;
    }

    public function getProductdescription(): ?string
    {
        return $this->productdescription;
    }

    public function setProductdescription(string $productdescription): self
    {
        $this->productdescription = $productdescription;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }
}
