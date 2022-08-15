<?php

namespace App\Domain\Service;

use App\Entity\Address;
use App\Type\Request\CreateAddressRequest;

class AddressDomainService
{
    public function createAddress(CreateAddressRequest $createAddressRequest): Address
    {
        $address = new Address();

        $address->setStreet($createAddressRequest->street);
        $address->setCity($createAddressRequest->city);
        $address->setZipCode($createAddressRequest->zipCode);

        return $address;
    }
}