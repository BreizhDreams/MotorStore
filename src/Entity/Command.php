<?php

namespace App\Entity;

use App\Repository\CommandRepository;
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
    private ?string $commandNumber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commandDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandNumber(): ?string
    {
        return $this->commandNumber;
    }

    public function setCommandNumber(string $commandNumber): self
    {
        $this->commandNumber = $commandNumber;

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
}
