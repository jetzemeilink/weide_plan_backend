<?php

namespace App\Type\View;

use DateTimeInterface;

class BookingView
{
    public ?int $id = null;
    public ?GuestView $guest = null;
    public ?SpotView $spot = null;
    public ?CampingEquipmentView $campingEquipment = null;
    public ?InvoiceView $invoice = null;
    public ?DateTimeInterface $arrivalDate = null;
    public ?DateTimeInterface $departureDate = null;
    public ?string $comment = null;
}