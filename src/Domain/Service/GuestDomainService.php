<?php

namespace App\Domain\Service;

use App\Entity\Address;
use App\Entity\Guest;
use App\Type\Request\CreateGuestRequest;

class GuestDomainService
{
    public function createGuest(CreateGuestRequest $createGuestRequest, Address $address): Guest
    {
        $guest = new Guest();

        $guest->setName($createGuestRequest->name)
            ->setNumberOfPax($createGuestRequest->numberOfPax)
            ->setHasDog($createGuestRequest->hasDog)
            ->setAddress($address);

        return $guest;
    }
}