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

    #[ORM\Column(type: 'integer')]
    private $numberOfPax;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $zipcode;

    #[ORM\Column(type: 'boolean')]
    private $hasDog;

    #[ORM\OneToOne(mappedBy: 'guestId', targetEntity: Invoice::class, cascade: ['persist', 'remove'])]
    private $invoice;

    #[ORM\OneToOne(mappedBy: 'guest_id', targetEntity: Booking::class, cascade: ['persist', 'remove'])]
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

    public function getNumberOfPax(): ?int
    {
        return $this->numberOfPax;
    }

    public function setNumberOfPax(int $numberOfPax): self
    {
        $this->numberOfPax = $numberOfPax;

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

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function isHasDog(): ?bool
    {
        return $this->hasDog;
    }

    public function setHasDog(bool $hasDog): self
    {
        $this->hasDog = $hasDog;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        // unset the owning side of the relation if necessary
        if ($invoice === null && $this->invoice !== null) {
            $this->invoice->setGuestId(null);
        }

        // set the owning side of the relation if necessary
        if ($invoice !== null && $invoice->getGuest() !== $this) {
            $invoice->setGuest($this);
        }

        $this->invoice = $invoice;

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
