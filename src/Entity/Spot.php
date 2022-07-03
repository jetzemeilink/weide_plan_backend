<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $size;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $distance_electricity;

    #[ORM\Column(type: 'boolean')]
    private bool $isSeasonSpot;

    #[ORM\ManyToMany(targetEntity: Booking::class, mappedBy: 'spotId')]
    private Collection $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDistanceElectricity(): ?string
    {
        return $this->distance_electricity;
    }

    public function setDistanceElectricity(?string $distance_electricity): self
    {
        $this->distance_electricity = $distance_electricity;

        return $this;
    }

    public function isIsSeasonSpot(): ?bool
    {
        return $this->isSeasonSpot;
    }

    public function setIsSeasonSpot(bool $isSeasonSpot): self
    {
        $this->isSeasonSpot = $isSeasonSpot;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->remove($booking);
        }

        return $this;
    }
}
