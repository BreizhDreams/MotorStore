<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column]
    private ?float $prixTTC = null;

    #[ORM\ManyToOne(inversedBy: 'productVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $categoryVO = null;

    #[ORM\ManyToMany(targetEntity: Advantage::class, inversedBy: 'productVOs')]
    private Collection $advantageVOs;

    #[ORM\Column(length: 255)]
    private ?string $photoURL = null;

    #[ORM\ManyToOne(inversedBy: 'productVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brandVO = null;

    public function __construct()
    {
        $this->advantageVOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    public function getCategoryVO(): ?Category
    {
        return $this->categoryVO;
    }

    public function setCategoryVO(?Category $categoryVO): self
    {
        $this->categoryVO = $categoryVO;

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
        }

        return $this;
    }

    public function removeAdvantageVO(Advantage $advantageVO): self
    {
        $this->advantageVOs->removeElement($advantageVO);

        return $this;
    }

    public function getPhotoURL(): ?string
    {
        return $this->photoURL;
    }

    public function setPhotoURL(string $photoURL): self
    {
        $this->photoURL = $photoURL;

        return $this;
    }

    public function getBrandVO(): ?Brand
    {
        return $this->brandVO;
    }

    public function setBrandVO(?Brand $brandVO): self
    {
        $this->brandVO = $brandVO;

        return $this;
    }
}
