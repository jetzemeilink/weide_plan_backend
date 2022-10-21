<?php

use App\Application\Service\AddressApplicationService;
use App\Tests\BaseTestCase;
use App\Tests\Factory\AddressFactory;
use App\Type\Request\CreateAddressRequest;
use App\Type\View\AddressView;
use Doctrine\ORM\EntityNotFoundException;

class AddressApplicationServiceTest extends BaseTestCase
{
  private AddressApplicationService $addressApplicationService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->addressApplicationService = self::getContainer()->get(AddressApplicationService::class);
  }

  public function testCanCreateAddressWithValidInput(): void
  {
    $addressRequest = new CreateAddressRequest();
    $addressRequest->city = $this->faker->city();
    $addressRequest->street = $this->faker->streetAddress();
    $addressRequest->zipCode = $this->faker->postcode();

    $result = $this->addressApplicationService->createAddress($addressRequest);

    $this->assertInstanceOf(AddressView::class, $result);
  }

  public function testCannotGetAddressWithInvalidId(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $this->addressApplicationService->getAddress(999999);
  }

  public function testCanGetAddressWithValidId(): void
  {
    $address = AddressFactory::createOne();

    $result = $this->addressApplicationService->getAddress($address->getId());

    $this->assertInstanceOf(AddressView::class, $result);
    $this->assertSame($address->getId(), $result->id);
  }
}