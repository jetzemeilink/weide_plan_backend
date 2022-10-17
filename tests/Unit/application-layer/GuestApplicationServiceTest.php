<?php

use App\Application\Service\GuestApplicationService;
use App\Entity\Address;
use App\Tests\BaseTestCase;
use App\Tests\Factory\AddressFactory;
use App\Type\Request\CreateGuestRequest;
use App\Type\View\GuestView;
use Doctrine\ORM\EntityNotFoundException;

class GuestApplicationServiceTest extends BaseTestCase
{
  private GuestApplicationService $guestApplicationService;
  private Address $address;
  protected function setUp(): void
  {
    parent::setUp();

    $this->guestApplicationService = self::getContainer()->get(GuestApplicationService::class);
    $this->address = AddressFactory::createOne()->object();
  }

  public function testCannotCreateGuestWithNonExistentAddress(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $guestRequest = new CreateGuestRequest();
    $guestRequest->name = $this->faker->name();
    $guestRequest->hasDog = $this->faker->boolean();
    $guestRequest->numberOfPax = $this->faker->randomNumber();
    $guestRequest->addressId = 999999;

    $this->guestApplicationService->createGuest($guestRequest);
  }

  public function testCanCreateGuestWithValidInput(): void
  {
    $guestRequest = new CreateGuestRequest();
    $guestRequest->name = $this->faker->name();
    $guestRequest->hasDog = $this->faker->boolean();
    $guestRequest->numberOfPax = $this->faker->randomNumber();
    $guestRequest->addressId = $this->address->getId();

    $result = $this->guestApplicationService->createGuest($guestRequest);

    $this->assertInstanceOf(GuestView::class, $result);
  }
}