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
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\OneToMany(mappedBy: 'productVO', targetEntity: CommandProduct::class)]
    private Collection $commandVOs;

    public function __construct()
    {
        $this->commandVOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, CommandProduct>
     */
    public function getCommandVOs(): Collection
    {
        return $this->commandVOs;
    }

    public function addCommandVO(CommandProduct $commandVO): self
    {
        if (!$this->commandVOs->contains($commandVO)) {
            $this->commandVOs->add($commandVO);
            $commandVO->setProductVO($this);
        }

        return $this;
    }

    public function removeCommandVO(CommandProduct $commandVO): self
    {
        if ($this->commandVOs->removeElement($commandVO)) {
            // set the owning side to null (unless already changed)
            if ($commandVO->getProductVO() === $this) {
                $commandVO->setProductVO(null);
            }
        }

        return $this;
    }
}
