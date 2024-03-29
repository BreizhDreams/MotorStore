<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un compte utilisateur existe déja avec cette addresse email.')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank()]
    private ?string $email = null;
    
    #[ORM\Column]
    private array $roles = [];
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Regex("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,100}$/")]
    private ?string $password = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $lastName = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $firstName = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $address = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/")]
    private ?string $zipCode = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $city = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Regex("/^((\+)33|0)[1-9](\d{2}){4}$/")]
    private ?string $telNumber = null;
    
    #[ORM\OneToOne(inversedBy: 'userVO', cascade: ['persist', 'remove'])]
    private ?FidelityCard $fidelityCardVO = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\OneToMany(mappedBy: 'userVO', targetEntity: Address::class)]
    private Collection $addressVOs;

    #[ORM\OneToMany(mappedBy: 'userVO', targetEntity: Order::class)]
    private Collection $orderVOs;

    public function __construct()
    {
        $this->addressVOs = new ArrayCollection();
        $this->orderVOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
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

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

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

    public function getTelNumber(): ?string
    {
        return $this->telNumber;
    }

    public function setTelNumber(string $telNumber): self
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    public function getFidelityCardVO(): ?FidelityCard
    {
        return $this->fidelityCardVO;
    }

    public function setFidelityCardVO(?FidelityCard $fidelityCardVO): self
    {
        $this->fidelityCardVO = $fidelityCardVO;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddressVOs(): Collection
    {
        return $this->addressVOs;
    }

    public function addAddressVO(Address $addressVO): self
    {
        if (!$this->addressVOs->contains($addressVO)) {
            $this->addressVOs->add($addressVO);
            $addressVO->setUserVO($this);
        }

        return $this;
    }

    public function removeAddressVO(Address $addressVO): self
    {
        if ($this->addressVOs->removeElement($addressVO)) {
            // set the owning side to null (unless already changed)
            if ($addressVO->getUserVO() === $this) {
                $addressVO->setUserVO(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderVOs(): Collection
    {
        return $this->orderVOs;
    }

    public function addOrderVO(Order $orderVO): self
    {
        if (!$this->orderVOs->contains($orderVO)) {
            $this->orderVOs->add($orderVO);
            $orderVO->setUserVO($this);
        }

        return $this;
    }

    public function removeOrderVO(Order $orderVO): self
    {
        if ($this->orderVOs->removeElement($orderVO)) {
            // set the owning side to null (unless already changed)
            if ($orderVO->getUserVO() === $this) {
                $orderVO->setUserVO(null);
            }
        }

        return $this;
    }
}
