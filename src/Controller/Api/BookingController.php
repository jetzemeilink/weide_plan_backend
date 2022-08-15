<?php

namespace App\Controller\Api;

use App\Application\Service\BookingApplicationService;
use App\Type\Request\CreateBookingRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    public function __construct(private BookingApplicationService $bookingApplicationService)
    {
    }

    /**
     * @ParamConverter(name="RequestParamConverter", class="CreateGuestRequest|CreateBookingRequest|CreateAddressRequest", options={"multiple"})
     */
    public function createBooking(Request $request, CreateBookingRequest $createBookingRequest): Response
    {
        $booking = $this->bookingApplicationService->createBooking(
            $request->attributes->get('createBookingRequest'),
            $request->attributes->get('createGuestRequest'),
            $request->attributes->get('createAddressRequest'));


        // TODO Fix circular reference bug (custom serializer/normalizer?)
        return $this->json($booking);
    }
}
