<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'addressVOs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userVO = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $name = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $firstName = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $lastName = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $address = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/")]
    private ?string $postalCode = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $city = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $country = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^((\+)33|0)[1-9](\d{2}){4}$/")]
    private ?string $phone = null;

    public function __toString()
    {
        return $this->getName() . '[br]' . $this->getAddress() . '[br]' . $this->getCity() . ' - ' . $this->getCountry();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
