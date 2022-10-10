<?php

namespace App\Type\Request;

class CreateGuestRequest
{
    public ?string $name = null;
    public ?int $numberOfPax = null;
    public ?bool $hasDog = null;
    public ?int $addressId = null;
}