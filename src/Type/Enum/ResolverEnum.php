<?php

namespace App\Type\Enum;

enum ResolverEnum: string
{
    case Bookings = 'bookings';
    case Booking = 'booking';
    case Guests = 'guests';
    case Guest = 'guest';
    case Spots = 'spots';
    case Spot = 'spot';
    case PaymentMethods = 'paymentMethods';
    case PaymentMethod = 'paymentMethod';
}