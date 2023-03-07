<?php

namespace App\Entity;

use App\Repository\FidelityCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FidelityCardRepository::class)]
class FidelityCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\OneToOne(mappedBy: 'fidelityCardVO', cascade: ['persist', 'remove'])]
    private ?User $userVO = null;

    #[ORM\ManyToMany(targetEntity: Advantage::class, mappedBy: 'fidelityCardVOs')]
    private Collection $advantageVOs;

    public function __construct()
    {
        $this->advantageVOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): self
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    public function getUserVO(): ?User
    {
        return $this->userVO;
    }

    public function setUserVO(?User $userVO): self
    {
        // unset the owning side of the relation if necessary
        if ($userVO === null && $this->userVO !== null) {
            $this->userVO->setFidelityCardVO(null);
        }

        // set the owning side of the relation if necessary
        if ($userVO !== null && $userVO->getFidelityCardVO() !== $this) {
            $userVO->setFidelityCardVO($this);
        }

        $this->userVO = $userVO;

        return $this;
    }

    /**
     * @return Collection<int, Advantage>
     */
    public function getAdvantageVOs(): Collection
    {
        return $this->advantageVOs;
    }

    public function addAdvantageVO(Advantage $advantageVO): self
    {
        if (!$this->advantageVOs->contains($advantageVO)) {
            $this->advantageVOs->add($advantageVO);
            $advantageVO->addFidelityCardVO($this);
        }

        return $this;
    }

    public function removeAdvantageVO(Advantage $advantageVO): self
    {
        if ($this->advantageVOs->removeElement($advantageVO)) {
            $advantageVO->removeFidelityCardVO($this);
        }

        return $this;
    }
}
