<?php

namespace App\Domain\Service;

use App\Entity\Address;
use App\Entity\Booking;
use App\Entity\CampingEquipment;
use App\Entity\Guest;
use App\Entity\Spot;
use App\Type\Request\CreateBookingRequest;
use DateTime;

class BookingDomainService
{

    public function createBooking(
        CreateBookingRequest $createBookingRequest,
        Spot $spot,
        Guest $guest,
        CampingEquipment $campingEquipment): Booking
    {
        $booking = new Booking();

        $booking->setSpot($spot)
            ->setGuest($guest)
            ->setCampingEquipment($campingEquipment)
            ->setArrivalDate(new DateTime($createBookingRequest->arrivalDate))
            ->setDepartureDate(new DateTime($createBookingRequest->departureDate))
            ->setComment($createBookingRequest->comment);

        return $booking;
    }
}