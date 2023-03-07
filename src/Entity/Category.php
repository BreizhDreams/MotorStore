<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categoryVO', targetEntity: Product::class)]
    private Collection $productVOs;

    #[ORM\ManyToMany(targetEntity: Advantage::class, inversedBy: 'categoryVOs')]
    private Collection $advantageVOs;

    public function __construct()
    {
        $this->productVOs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductVOs(): Collection
    {
        return $this->productVOs;
    }

    public function addProductVO(Product $productVO): self
    {
        if (!$this->productVOs->contains($productVO)) {
            $this->productVOs->add($productVO);
            $productVO->setCategoryVO($this);
        }

        return $this;
    }

    public function removeProductVO(Product $productVO): self
    {
        if ($this->productVOs->removeElement($productVO)) {
            // set the owning side to null (unless already changed)
            if ($productVO->getCategoryVO() === $this) {
                $productVO->setCategoryVO(null);
            }
        }

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
}
