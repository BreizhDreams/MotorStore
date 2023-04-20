<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userVO = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $transporterName = null;

    #[ORM\Column]
    private ?float $transporterPrice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $delivry = null;

    #[ORM\OneToMany(mappedBy: 'orderVO', targetEntity: OrderDetails::class)]
    private Collection $orderDetailsVOs;

    #[ORM\Column]
    private ?bool $isPaid = null;

    public function __construct()
    {
        $this->orderDetailsVOs = new ArrayCollection();
    }

    public function getTotal()
    {
        $total = null;
        foreach ($this->getOrderDetails()->getValues() as $product) {
            $total = $total + ($product->getPrice() * $product->getQuantity());
        }
        return $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserVO(): ?User
    {
        return $this->userVO;
    }

    public function setUserVO(?User $userVO): self
    {
        $this->userVO = $userVO;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTransporterName(): ?string
    {
        return $this->transporterName;
    }

    public function setTransporterName(string $transporterName): self
    {
        $this->transporterName = $transporterName;

        return $this;
    }

    public function getTransporterPrice(): ?float
    {
        return $this->transporterPrice;
    }

    public function setTransporterPrice(float $transporterPrice): self
    {
        $this->transporterPrice = $transporterPrice;

        return $this;
    }

    public function getDelivry(): ?string
    {
        return $this->delivry;
    }

    public function setDelivry(string $delivry): self
    {
        $this->delivry = $delivry;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetailsVOs;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetailsVOs->contains($orderDetail)) {
            $this->orderDetailsVOs->add($orderDetail);
            $orderDetail->setOrderVO($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetailsVOs->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrderVO() === $this) {
                $orderDetail->setOrderVO(null);
            }
        }

        return $this;
    }

    public function isIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}
