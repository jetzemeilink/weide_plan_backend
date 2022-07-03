<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'invoice', targetEntity: Guest::class, cascade: ['persist', 'remove'])]
    private Guest $guest;

    #[ORM\Column(type: 'integer')]
    private int $amountBruto;

    #[ORM\Column(type: 'integer')]
    private int $AmountNetto;

    #[ORM\ManyToOne(targetEntity: PaymentMethod::class, inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private PaymentMethod $paymentMethod;

    #[ORM\OneToOne(mappedBy: 'invoiceId', targetEntity: Booking::class, cascade: ['persist', 'remove'])]
    private Booking $booking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getAmountBruto(): ?int
    {
        return $this->amountBruto;
    }

    public function setAmountBruto(int $amountBruto): self
    {
        $this->amountBruto = $amountBruto;

        return $this;
    }

    public function getAmountNetto(): ?int
    {
        return $this->AmountNetto;
    }

    public function setAmountNetto(int $AmountNetto): self
    {
        $this->AmountNetto = $AmountNetto;

        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): self
    {
        // set the owning side of the relation if necessary
        if ($booking !== null && $booking->getInvoice() !== $this) {
            $booking->setInvoice($this);
        }

        $this->booking = $booking;

        return $this;
    }
}
