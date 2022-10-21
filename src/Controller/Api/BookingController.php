<?php

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Application\Service\BookingApplicationService;
use App\Type\Request\CreateBookingRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    public function __construct(private BookingApplicationService $bookingApplicationService)
    {
    }

    /**
     * @ParamConverter(name="RequestParamConverter", class="CreateBookingRequest")
     */
    public function createBooking(Request $request, CreateBookingRequest $createBookingRequest): Response
    {
        $bookingView = $this->bookingApplicationService->createBooking(
            $createBookingRequest,
            $request->get('guestId'),
            $request->get('addressId'));

        return $this->json($bookingView);
    }

    public function getBooking(Request $request): Response
    {
        $booking = $this->bookingApplicationService->getBooking($request->get('bookingId'));

        return $this->json($booking);
    }
}
