<?php

namespace App\Tests\Unit\DomainLayer;

use App\Domain\Service\AddressDomainService;
use App\Entity\Address;
use App\Tests\BaseTestCase;
use App\Type\Request\CreateAddressRequest;

class AddressDomainServiceTest extends BaseTestCase
{
  private AddressDomainService $addressDomainService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->addressDomainService = self::getContainer()->get(AddressDomainService::class);
  }

  public function testCanCreateAddressWithValidInput(): void
  {
    $addressRequest = new CreateAddressRequest();
    $addressRequest->city = $this->faker->city();
    $addressRequest->street = $this->faker->streetAddress();
    $addressRequest->zipCode = $this->faker->postcode();

    $result = $this->addressDomainService->createAddress($addressRequest);

    $this->assertInstanceOf(Address::class, $result);
  }
}