<?php

namespace App\Domain\Service;

use App\Entity\Booking;
use App\Shared\Helpers\DateValidation;
use App\Type\Request\CreateBookingRequest;
use DateTime;
use InvalidArgumentException;

class BookingDomainService
{

    public function createBooking(CreateBookingRequest $createBookingRequest): Booking
    {
        $booking = new Booking();

        if (!DateValidation::isValidDate($createBookingRequest->arrivalDate)) {
            throw new InvalidArgumentException("Invalid date format");
        }

        if (!DateValidation::isValidDate($createBookingRequest->departureDate)) {
            throw new InvalidArgumentException("Invalid date format");
        }

        $booking->setArrivalDate(new DateTime($createBookingRequest->arrivalDate))
            ->setDepartureDate(new DateTime($createBookingRequest->departureDate))
            ->setComment($createBookingRequest->comment);

        return $booking;
    }
}