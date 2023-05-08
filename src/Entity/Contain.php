<?php

namespace App\Entity;

use App\Repository\ContainRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContainRepository::class)]
class Contain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'containVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FidelityCard $fidelityCardVO = null;

    #[ORM\ManyToOne(inversedBy: 'containVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Advantage $advantageVO = null;

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

    public function getFidelityCardVO(): ?FidelityCard
    {
        return $this->fidelityCardVO;
    }

    public function setFidelityCardVO(?FidelityCard $fidelityCardVO): self
    {
        $this->fidelityCardVO = $fidelityCardVO;

        return $this;
    }

    public function getAdvantageVO(): ?Advantage
    {
        return $this->advantageVO;
    }

    public function setAdvantageVO(?Advantage $advantageVO): self
    {
        $this->advantageVO = $advantageVO;

        return $this;
    }
}
