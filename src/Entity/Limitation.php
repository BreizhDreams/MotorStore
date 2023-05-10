<?php

namespace App\Entity;

use App\Repository\LimitationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LimitationRepository::class)]
class Limitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $limitQuantity = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne(inversedBy: 'limitationVOs')]
    private ?Product $productVO = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLimitQuantity(): ?int
    {
        return $this->limitQuantity;
    }

    public function setLimitQuantity(int $limitQuantity): self
    {
        $this->limitQuantity = $limitQuantity;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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
