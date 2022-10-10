<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(mappedBy: 'guest', targetEntity: Address::class, cascade: ['persist', 'remove'])]
    private $address;

    #[ORM\Column(type: 'integer')]
    private $numberOfPax;

    #[ORM\Column(type: 'boolean')]
    private $hasDog;

    #[ORM\OneToOne(mappedBy: 'guest', targetEntity: Booking::class, cascade: ['persist', 'remove'])]
    private $booking;

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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        // unset the owning side of the relation if necessary
        if ($address === null && $this->address !== null) {
            $this->address->setGuest(null);
        }

        // set the owning side of the relation if necessary
        if ($address !== null && $address->getGuest() !== $this) {
            $address->setGuest($this);
        }

        $this->address = $address;

        return $this;
    }

    public function getNumberOfPax(): ?int
    {
        return $this->numberOfPax;
    }

    public function setNumberOfPax(int $numberOfPax): self
    {
        $this->numberOfPax = $numberOfPax;

        return $this;
    }

    public function getHasDog(): ?bool
    {
        return $this->hasDog;
    }

    public function setHasDog(bool $hasDog): self
    {
        $this->hasDog = $hasDog;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking): self
    {
        // set the owning side of the relation if necessary
        if ($booking->getGuest() !== $this) {
            $booking->setGuest($this);
        }

        $this->booking = $booking;

        return $this;
    }
}
