<?php

use App\Entity\Address;
use App\Type\Request\CreateAddressRequest;
use App\Domain\Service\AddressDomainService;
use App\Shared\Helpers\Mapper;

class AddressApplicationService
{
  public function __construct(private AddressDomainService $addressDomainService)
  {
    
  }
  public function createAddress(CreateAddressRequest $createAddressRequest): Address
  {
    $address = $this->addressDomainService->createAddress($createAddressRequest);

    return $address;
  }
}