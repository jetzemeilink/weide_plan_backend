<?php

namespace App\Controller\Api;

use App\Type\Request\CreateBookingRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{

    /**
     * @ParamConverter(name="RequestParamConverter", class="CreateBookingRequest")
     */
    public function createBooking(Request $request, CreateBookingRequest $createBookingRequest): Response
    {
        //        TODO implement logic
        return $this->json($createBookingRequest);
    }
}
