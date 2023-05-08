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


    #[ORM\OneToMany(mappedBy: 'fidelityCardVO', targetEntity: Contain::class)]
    private Collection $containVOs;

    public function __construct()
    {
        $this->containVOs = new ArrayCollection();
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

    public function getAmountOfPoints(float $totalOrder): int
    {
        $roundTotalOrder = floor($totalOrder) / 100;
        $totalPoints = floor($roundTotalOrder / 10);
        return $totalPoints;
    }

    public function addPoints(int $totalPoints){
        $this->setTotalPoints($totalPoints + $this->getTotalPoints());
    }

    public function removePoints(int $points){
        $this->setTotalPoints($this->getTotalPoints() - $points);
    }

    /**
     * @return Collection<int, Contain>
     */
    public function getContainVOs(): Collection
    {
        return $this->containVOs;
    }

    public function addContainVO(Contain $containVO): self
    {
        if (!$this->containVOs->contains($containVO)) {
            $this->containVOs->add($containVO);
            $containVO->setFidelityCardVO($this);
        }

        return $this;
    }

    public function removeContainVO(Contain $containVO): self
    {
        if ($this->containVOs->removeElement($containVO)) {
            // set the owning side to null (unless already changed)
            if ($containVO->getFidelityCardVO() === $this) {
                $containVO->setFidelityCardVO(null);
            }
        }
        return $this;
    }
}
