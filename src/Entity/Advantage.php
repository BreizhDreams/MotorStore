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

    #[ORM\ManyToOne(inversedBy: 'advantageVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdvantageType $advantageTypeVO = null;

    #[ORM\ManyToMany(targetEntity: FidelityCard::class, inversedBy: 'advantageVOs')]
    private Collection $fidelityCardVOs;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'advantageVOs')]
    private Collection $productVOs;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'advantageVOs')]
    private Collection $categoryVOs;

    public function __construct()
    {
        $this->fidelityCardVOs = new ArrayCollection();
        $this->productVOs = new ArrayCollection();
        $this->categoryVOs = new ArrayCollection();
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

    public function getAdvantageTypeVO(): ?AdvantageType
    {
        return $this->advantageTypeVO;
    }

    public function setAdvantageTypeVO(?AdvantageType $advantageTypeVO): self
    {
        $this->advantageTypeVO = $advantageTypeVO;

        return $this;
    }

    /**
     * @return Collection<int, FidelityCard>
     */
    public function getFidelityCardVOs(): Collection
    {
        return $this->fidelityCardVOs;
    }

    public function addFidelityCardVO(FidelityCard $fidelityCardVO): self
    {
        if (!$this->fidelityCardVOs->contains($fidelityCardVO)) {
            $this->fidelityCardVOs->add($fidelityCardVO);
        }

        return $this;
    }

    public function removeFidelityCardVO(FidelityCard $fidelityCardVO): self
    {
        $this->fidelityCardVOs->removeElement($fidelityCardVO);

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
}
