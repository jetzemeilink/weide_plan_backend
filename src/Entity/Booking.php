<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'booking', targetEntity: Guest::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Guest $guest;

    #[ORM\ManyToOne(targetEntity: Spot::class, cascade: ['persist', 'remove'], inversedBy: 'booking')]
    private Spot $spot;

    #[ORM\ManyToOne(targetEntity: CampingEquipment::class)]
    #[ORM\JoinColumn(nullable: false)]
    private CampingEquipment $campingEquipment;

    #[ORM\OneToOne(inversedBy: 'booking', targetEntity: Invoice::class, cascade: ['persist', 'remove'])]
    private Invoice $invoice;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $arrivalDate;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $departureDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getSpot(): Spot
    {
        return $this->spot;
    }

    public function setSpot(Spot $spot): self {
       $this->spot = $spot;

       return $this;
    }

    public function getCampingEquipment(): ?CampingEquipment
    {
        return $this->campingEquipment;
    }

    public function setCampingEquipment(?CampingEquipment $campingEquipment): self
    {
        $this->campingEquipment = $campingEquipment;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getArrivalDate(): ?DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
