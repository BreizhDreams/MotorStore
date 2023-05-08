<?php

namespace App\Entity;

use App\Repository\AdvantageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvantageRepository::class)]
class Advantage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expirationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $advantageName = null;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'advantageVOs')]
    private Collection $productVOs;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'advantageVOs')]
    private Collection $categoryVOs;

    #[ORM\Column(nullable: true)]
    private ?int $amount = null;

    #[ORM\OneToMany(mappedBy: 'advantageVO', targetEntity: Contain::class)]
    private Collection $containVOs;

    public function __construct()
    {
        $this->productVOs = new ArrayCollection();
        $this->categoryVOs = new ArrayCollection();
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

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getAdvantageName(): ?string
    {
        return $this->advantageName;
    }

    public function setAdvantageName(string $advantageName): self
    {
        $this->advantageName = $advantageName;

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
            $productVO->addAdvantageVO($this);
        }

        return $this;
    }

    public function removeProductVO(Product $productVO): self
    {
        if ($this->productVOs->removeElement($productVO)) {
            $productVO->removeAdvantageVO($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategoryVOs(): Collection
    {
        return $this->categoryVOs;
    }

    public function addCategoryVO(Category $categoryVO): self
    {
        if (!$this->categoryVOs->contains($categoryVO)) {
            $this->categoryVOs->add($categoryVO);
            $categoryVO->addAdvantageVO($this);
        }

        return $this;
    }

    public function removeCategoryVO(Category $categoryVO): self
    {
        if ($this->categoryVOs->removeElement($categoryVO)) {
            $categoryVO->removeAdvantageVO($this);
        }

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
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
            $containVO->setAdvantageVO($this);
        }

        return $this;
    }

    public function removeContainVO(Contain $containVO): self
    {
        if ($this->containVOs->removeElement($containVO)) {
            // set the owning side to null (unless already changed)
            if ($containVO->getAdvantageVO() === $this) {
                $containVO->setAdvantageVO(null);
            }
        }

        return $this;
    }
}
