<?php

namespace App\Entity;

use App\Repository\TransporterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransporterRepository::class)]
class Transporter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $transportagency = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransportagency(): ?string
    {
        return $this->transportagency;
    }

    public function setTransportagency(string $transportagency): self
    {
        $this->transportagency = $transportagency;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->getTransportagency().'[br]'.number_format($this->getPrice()/100, 2, ',', '.').' €[br]'.
                $this->getDescription().'[hr]';
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
