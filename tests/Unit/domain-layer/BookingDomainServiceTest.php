<?php

use App\Domain\Service\BookingDomainService;
use App\Entity\Booking;
use App\Tests\BaseTestCase;
use App\Type\Request\CreateBookingRequest;

class BookingDomainServiceTest extends BaseTestCase
{
  private BookingDomainService $bookingDomainService;
  protected function setUp(): void
  {
    parent::setUp();
    
    $this->bookingDomainService = self::getContainer()->get(BookingDomainService::class);
  }

  public function testCannotCreateBookingWithInvalidArrivalDate(): void
  {
    $this->expectException(InvalidArgumentException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = 'not a date';
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->comment = 'I\'m a little comment';

    $this->bookingDomainService->createBooking($bookingRequest);
  }

  public function testCannotCreateBookingWithInvalidDepartureDate(): void
  {
    $this->expectException(InvalidArgumentException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = 'not a date';
    $bookingRequest->comment = 'I\'m a little comment';

    $this->bookingDomainService->createBooking($bookingRequest);
  }

  public function testCannotCreateBookingWithValidInput(): void
  {
    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->comment = 'I\'m a little comment';

    $result = $this->bookingDomainService->createBooking($bookingRequest);

    $this->assertInstanceOf(Booking::class, $result);
  }
}