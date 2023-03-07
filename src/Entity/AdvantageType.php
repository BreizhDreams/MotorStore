<?php

namespace App\Entity;

use App\Repository\AdvantageTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvantageTypeRepository::class)]
class AdvantageType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'advantageTypeVO', targetEntity: Advantage::class)]
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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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
            $advantageVO->setAdvantageTypeVO($this);
        }

        return $this;
    }

    public function removeAdvantageVO(Advantage $advantageVO): self
    {
        if ($this->advantageVOs->removeElement($advantageVO)) {
            // set the owning side to null (unless already changed)
            if ($advantageVO->getAdvantageTypeVO() === $this) {
                $advantageVO->setAdvantageTypeVO(null);
            }
        }

        return $this;
    }
}
