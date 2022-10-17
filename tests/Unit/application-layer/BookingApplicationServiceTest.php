<?php

namespace App\Tests\UnitTests\ApplicationLayer;

use App\Application\Service\BookingApplicationService;
use App\Entity\Address;
use App\Entity\CampingEquipment;
use App\Entity\Guest;
use App\Entity\Spot;
use App\Tests\Factory\AddressFactory;
use App\Type\Request\CreateBookingRequest;
use Doctrine\ORM\EntityNotFoundException;
use \App\Tests\BaseTestCase;
use App\Tests\Factory\GuestFactory;
use InvalidArgumentException;
use App\Type\View\BookingView;

class BookingApplicationServiceTest extends BaseTestCase
{
  private BookingApplicationService $applicationService;
  private Address $address;
  private Guest $guest;

  protected function setUp(): void
  {
    parent::setUp();

    $this->applicationService = self::getContainer()->get(BookingApplicationService::class);

    $this->address = AddressFactory::createOne()->object();
    $this->guest = GuestFactory::createOne()->object();
  }

  public function testCannotCreateBookingWithNonExistentGuest(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = Spot::FIVE;
    $bookingRequest->campingEquipmentCode = CampingEquipment::CAMPER_ELECTRIC;
  
    $this->applicationService->createBooking($bookingRequest, 999999, $this->address->getId());
  }

  public function testCannotCreateBookingWithNonExistentSpot(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = 'DOES NOT EXIST';
    $bookingRequest->campingEquipmentCode = CampingEquipment::CAMPER_ELECTRIC;

    $this->applicationService->createBooking($bookingRequest, 999999, $this->address->getId());
  }

  public function testCannotCreateBookingWithNonExistentCampingEquipment(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = Spot::FIVE;
    $bookingRequest->campingEquipmentCode = 'DOES NOT EXIST';

    $this->applicationService->createBooking($bookingRequest, 999999, $this->address->getId());
  }

  public function testCannotCreateBookingWithNonExistentAddress(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = Spot::FIVE;
    $bookingRequest->campingEquipmentCode = CampingEquipment::CAMPER_ELECTRIC;

    $this->applicationService->createBooking($bookingRequest, $this->guest->getId(), 999999);
  }

  public function testCanCreateBookingWithValidInput(): void
  {
    $bookingRequest = new CreateBookingRequest();
    $bookingRequest->arrivalDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->departureDate = $this->faker->dateTime()->format('d-m-Y');
    $bookingRequest->spotCode = Spot::FIVE;
    $bookingRequest->campingEquipmentCode = CampingEquipment::CAMPER_ELECTRIC;

    $result = $this->applicationService->createBooking($bookingRequest, $this->guest->getId(), $this->address->getId());

    $this->assertInstanceOf(BookingView::class, $result);
  }
}