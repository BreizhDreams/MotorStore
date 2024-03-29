<?php

namespace App\Entity;

use App\Repository\OrderDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderDetailsRepository::class)]
class OrderDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $orderVO = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $product = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^(\d*)$/")]
    private ?int $quantity = null;
    
    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^\d+(.\d{1,2})?$/")]
    private ?float $price = null;
    
    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^\d+(.\d{1,2})?$/")]
    private ?float $total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderVO(): ?Order
    {
        return $this->orderVO;
    }

    public function setOrderVO(?Order $orderVO): self
    {
        $this->orderVO = $orderVO;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function __toString()
    {
        return $this->getProduct().' x '.$this->getQuantity();
    }
}
