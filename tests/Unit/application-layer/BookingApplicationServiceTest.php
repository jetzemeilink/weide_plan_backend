<?php

namespace App\Tests\UnitTests\ApplicationLayer;

use App\Application\Service\BookingApplicationService;
use App\Tests\Factory\AddressFactory;
use App\Type\Request\CreateBookingRequest;
use Doctrine\ORM\EntityNotFoundException;
use \App\Tests\BaseTestCase;

class BookingApplicationServiceTest extends BaseTestCase
{
  private BookingApplicationService $applicationService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->applicationService = self::getContainer()->get(BookingApplicationService::class);
    
  }

  public function testCannotCreateBookingWithNonExistentGuest(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = 'FOUR';
    $bookingRequest->campingEquipmentCode = 'CAR_E';

    $address = AddressFactory::createOne()->object();
  
    $this->applicationService->createBooking($bookingRequest, $address->getId(), 999999);
  }
}