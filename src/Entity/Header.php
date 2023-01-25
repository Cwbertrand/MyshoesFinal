<?php

namespace App\Entity;

use App\Repository\HeaderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeaderRepository::class)]
class Header
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $headertitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $headertext = null;

    #[ORM\Column(length: 255)]
    private ?string $headerimage = null;

    #[ORM\Column(length: 255)]
    private ?string $headerurl = null;

    #[ORM\Column(length: 255)]
    private ?string $headerbtn = null;

    #[ORM\Column]
    private ?bool $isPublish = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeadertitle(): ?string
    {
        return $this->headertitle;
    }

    public function setHeadertitle(?string $headertitle): self
    {
        $this->headertitle = $headertitle;

        return $this;
    }

    public function getHeadertext(): ?string
    {
        return $this->headertext;
    }

    public function setHeadertext(string $headertext): self
    {
        $this->headertext = $headertext;

        return $this;
    }

    public function getHeaderimage(): ?string
    {
        return $this->headerimage;
    }

    public function setHeaderimage(string $headerimage): self
    {
        $this->headerimage = $headerimage;

        return $this;
    }

    public function getHeaderurl(): ?string
    {
        return $this->headerurl;
    }

    public function setHeaderurl(string $headerurl): self
    {
        $this->headerurl = $headerurl;

        return $this;
    }

    public function getHeaderbtn(): ?string
    {
        return $this->headerbtn;
    }

    public function setHeaderbtn(string $headerbtn): self
    {
        $this->headerbtn = $headerbtn;

        return $this;
    }

    public function isIsPublish(): ?bool
    {
        return $this->isPublish;
    }

    public function setIsPublish(bool $isPublish): self
    {
        $this->isPublish = $isPublish;

        return $this;
    }
}
