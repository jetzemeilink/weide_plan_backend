<?php

namespace App\Tests\UnitTests\ApplicationLayer;

use App\Application\Service\BookingApplicationService;
use App\Type\Request\CreateBookingRequest;
use Doctrine\ORM\EntityNotFoundException;
use \App\Tests\TestCase;

class BookingApplicationServiceTest extends TestCase
{

  public function __construct(private BookingApplicationService $bookingApplicationService)
  {
  }
  // protected function setUp(): void
  // {
  //   parent::setUp();

  //   $this->applicationService = self::container
    
  // }
  public function testCannotCreateBookiingWithNonExistentGuest(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = 'FOUR';
    $bookingRequest->campingEquipmentCode = 'CAR_E';

    
  
    $this->bookingApplicationService->createBooking($bookingRequest);
  }
}