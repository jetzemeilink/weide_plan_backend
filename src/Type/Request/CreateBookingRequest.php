<?php

namespace App\Type\Request;

use DateTime;

class CreateBookingRequest
{
    public ?string $arrivalDate = null;
    public ?string $departureDate = null;
    public ?string $comment = null;
    public ?string $spotCode = null;
    public ?string $campingEquipmentCode = null;
}