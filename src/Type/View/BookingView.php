<?php

namespace App\Type\View;

use DateTime;

class BookingView
{
    public ?GuestView $guest = null;
    public ?SpotView $spot = null;
    public ?CampingEquipmentView $campingEquipment = null;
    public ?InvoiceView $invoice = null;
    public ?DateTime $arrivalDate = null;
    public ?DateTime $departureDate = null;
    public ?string $comment = null;
}