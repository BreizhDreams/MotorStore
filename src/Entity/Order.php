<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotBlank()]
    private ?string $transporterName = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^\d+(.\d{1,2})?$/")]
    private ?float $transporterPrice = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $delivry = null;

    #[ORM\OneToMany(mappedBy: 'orderVO', targetEntity: OrderDetails::class)]
    private Collection $orderDetailsVOs;

    #[ORM\Column]
    private ?bool $isPaid = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^([\d]{8})([\_]{1})([a-zA-Z\d]*)$/")]
    private ?string $reference = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stripeSessionId = null;

    #[ORM\Column]
    private ?bool $hasDiscountCode = null;

    #[ORM\ManyToOne(inversedBy: 'orderVOs')]
    private ?Advantage $advantageVO = null;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getStripeSessionId(): ?string
    {
        return $this->stripeSessionId;
    }

    public function setStripeSessionId(?string $stripeSessionId): self
    {
        $this->stripeSessionId = $stripeSessionId;

        return $this;
    }

    public function isHasDiscountCode(): ?bool
    {
        return $this->hasDiscountCode;
    }

    public function setHasDiscountCode(bool $hasDiscountCode): self
    {
        $this->hasDiscountCode = $hasDiscountCode;

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
