<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?float $totalHT = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commandDate = null;

    #[ORM\Column(length: 255)]
    private ?string $commandStatus = null;

    #[ORM\ManyToOne(inversedBy: 'commandVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userVO = null;

    #[ORM\OneToMany(mappedBy: 'commandVO', targetEntity: CommandProduct::class)]
    private Collection $commandProductVOs;

    public function __construct()
    {
        $this->commandProductVOs = new ArrayCollection();
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

    public function getTotalHT(): ?float
    {
        return $this->totalHT;
    }

    public function setTotalHT(float $totalHT): self
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getCommandDate(): ?\DateTimeInterface
    {
        return $this->commandDate;
    }

    public function setCommandDate(\DateTimeInterface $commandDate): self
    {
        $this->commandDate = $commandDate;

        return $this;
    }

    public function getCommandStatus(): ?string
    {
        return $this->commandStatus;
    }

    public function setCommandStatus(string $commandStatus): self
    {
        $this->commandStatus = $commandStatus;

        return $this;
    }

    public function getUserVO(): ?User
    {
        return $this->userVO;
    }

    public function setUserVO(?User $userVO): self
    {
        $this->userVO = $userVO;

        return $this;
    }

    /**
     * @return Collection<int, CommandProduct>
     */
    public function getCommandProductVOs(): Collection
    {
        return $this->commandProductVOs;
    }

    public function addCommandProductVO(CommandProduct $commandProductVO): self
    {
        if (!$this->commandProductVOs->contains($commandProductVO)) {
            $this->commandProductVOs->add($commandProductVO);
            $commandProductVO->setCommandVO($this);
        }

        return $this;
    }

    public function removeCommandProductVO(CommandProduct $commandProductVO): self
    {
        if ($this->commandProductVOs->removeElement($commandProductVO)) {
            // set the owning side to null (unless already changed)
            if ($commandProductVO->getCommandVO() === $this) {
                $commandProductVO->setCommandVO(null);
            }
        }

        return $this;
    }
}
