<?php

namespace App\Entity;

use App\Repository\CommandProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandProductRepository::class)]
class CommandProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'commandVOs')]
    private ?Product $productVO = null;

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

    public function getProductVO(): ?Product
    {
        return $this->productVO;
    }

    public function setProductVO(?Product $productVO): self
    {
        $this->productVO = $productVO;

        return $this;
    }
}
