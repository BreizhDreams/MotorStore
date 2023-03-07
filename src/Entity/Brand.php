<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'brandVO', targetEntity: Product::class)]
    private Collection $productVOs;

    public function __construct()
    {
        $this->productVOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $productVO->setBrandVO($this);
        }

        return $this;
    }

    public function removeProductVO(Product $productVO): self
    {
        if ($this->productVOs->removeElement($productVO)) {
            // set the owning side to null (unless already changed)
            if ($productVO->getBrandVO() === $this) {
                $productVO->setBrandVO(null);
            }
        }

        return $this;
    }
}
