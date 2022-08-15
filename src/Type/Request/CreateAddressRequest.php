<?php

namespace App\Type\Request;

class CreateAddressRequest
{
    public ?string $street = null;
    public ?string $city = null;
    public ?string $zipCode = null;
}