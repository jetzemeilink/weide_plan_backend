<?php

namespace App\Tests\Unit\DomainLayer;

use App\Domain\Service\GuestDomainService;
use App\Tests\BaseTestCase;
use App\Tests\Factory\AddressFactory;
use App\Type\Request\CreateGuestRequest;
use App\Entity\Guest;

class GuestDomainServiceTest extends BaseTestCase
{
  private GuestDomainService $guestDomainService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->guestDomainService = self::getContainer()->get(GuestDomainService::class);
  }

  public function testCanCreateGuestWithValidInput(): void
  {
    $guestRequest = new CreateGuestRequest();
    $guestRequest->addressId = AddressFactory::createOne()->getId();
    $guestRequest->hasDog = $this->faker->boolean();
    $guestRequest->name = $this->faker->name();
    $guestRequest->numberOfPax = $this->faker->randomNumber();

    $result = $this->guestDomainService->createGuest($guestRequest);

    $this->assertInstanceOf(Guest::class, $result);
  }
}