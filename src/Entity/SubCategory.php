<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubCategoryRepository::class)]
class SubCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'subCategoriesVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $categoryVO = null;

    #[ORM\OneToMany(mappedBy: 'subCategoryVO', targetEntity: Product::class)]
    private Collection $productVOs;

    public function __construct()
    {
        $this->productVOs = new ArrayCollection();
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
            $productVO->setSubCategoryVO($this);
        }

        return $this;
    }

    public function removeProductVO(Product $productVO): self
    {
        if ($this->productVOs->removeElement($productVO)) {
            // set the owning side to null (unless already changed)
            if ($productVO->getSubCategoryVO() === $this) {
                $productVO->setSubCategoryVO(null);
            }
        }

        return $this;
    }
}
