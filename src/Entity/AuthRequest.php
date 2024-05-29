<?php

namespace App\Entity;

use App\Repository\AuthRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthRequestRepository::class)]
class AuthRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $reqtime = null;

    #[ORM\Column(length: 255)]
    private ?string $ipaddress = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReqtime(): ?\DateTimeInterface
    {
        return $this->reqtime;
    }

    public function setReqtime(\DateTimeInterface $reqtime): static
    {
        $this->reqtime = $reqtime;

        return $this;
    }

    public function getIpaddress(): ?string
    {
        return $this->ipaddress;
    }

    public function setIpaddress(string $ipaddress): static
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->isValid;
    }

    public function setValid(?bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }
}
