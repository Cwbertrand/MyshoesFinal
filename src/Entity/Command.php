<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $transportagency = null;

    #[ORM\Column]
    private ?float $transportprice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $addressname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressmobile = null;

    #[ORM\Column(length: 255)]
    private ?string $addressstreet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addresscompany = null;

    #[ORM\Column(length: 255)]
    private ?string $addresscp = null;

    #[ORM\Column(length: 255)]
    private ?string $addresscity = null;

    #[ORM\Column(length: 255)]
    private ?string $addresscountry = null;

    #[ORM\ManyToOne(inversedBy: 'commands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'command', targetEntity: CommandDetail::class)]
    private Collection $commandDetails;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stripesessionid = null;

    #[ORM\Column]
    private ?bool $IsPaid = null;

    public function __construct()
    {
        $this->commandDetails = new ArrayCollection();
    }

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

    public function getTransportprice(): ?float
    {
        return $this->transportprice;
    }

    public function setTransportprice(float $transportprice): self
    {
        $this->transportprice = $transportprice;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getAddressname(): ?string
    {
        return $this->addressname;
    }

    public function setAddressname(string $addressname): self
    {
        $this->addressname = $addressname;

        return $this;
    }

    public function getAddressmobile(): ?string
    {
        return $this->addressmobile;
    }

    public function setAddressmobile(?string $addressmobile): self
    {
        $this->addressmobile = $addressmobile;

        return $this;
    }

    public function getAddressstreet(): ?string
    {
        return $this->addressstreet;
    }

    public function setAddressstreet(string $addressstreet): self
    {
        $this->addressstreet = $addressstreet;

        return $this;
    }

    public function getAddresscompany(): ?string
    {
        return $this->addresscompany;
    }

    public function setAddresscompany(?string $addresscompany): self
    {
        $this->addresscompany = $addresscompany;

        return $this;
    }

    public function getAddresscp(): ?string
    {
        return $this->addresscp;
    }

    public function setAddresscp(string $addresscp): self
    {
        $this->addresscp = $addresscp;

        return $this;
    }

    public function getAddresscity(): ?string
    {
        return $this->addresscity;
    }

    public function setAddresscity(string $addresscity): self
    {
        $this->addresscity = $addresscity;

        return $this;
    }

    public function getAddresscountry(): ?string
    {
        return $this->addresscountry;
    }

    public function setAddresscountry(string $addresscountry): self
    {
        $this->addresscountry = $addresscountry;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommandDetail>
     */
    public function getCommandDetails(): Collection
    {
        return $this->commandDetails;
    }

    public function addCommandDetail(CommandDetail $commandDetail): self
    {
        if (!$this->commandDetails->contains($commandDetail)) {
            $this->commandDetails->add($commandDetail);
            $commandDetail->setCommand($this);
        }

        return $this;
    }

    public function removeCommandDetail(CommandDetail $commandDetail): self
    {
        if ($this->commandDetails->removeElement($commandDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandDetail->getCommand() === $this) {
                $commandDetail->setCommand(null);
            }
        }

        return $this;
    }

    public function getStripesessionid(): ?string
    {
        return $this->stripesessionid;
    }

    public function setStripesessionid(?string $stripesessionid): self
    {
        $this->stripesessionid = $stripesessionid;

        return $this;
    }

    public function isIsPaid(): ?bool
    {
        return $this->IsPaid;
    }

    public function setIsPaid(bool $IsPaid): self
    {
        $this->IsPaid = $IsPaid;

        return $this;
    }
}
