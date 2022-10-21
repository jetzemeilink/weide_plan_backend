<?php

namespace App\Application\Service;

use App\Type\Request\CreateAddressRequest;
use App\Domain\Service\AddressDomainService;
use App\Entity\Address;
use App\Repository\AddressRepository;
use App\Shared\Helpers\Mapper;
use App\Type\View\AddressView;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class AddressApplicationService
{
  public function __construct(
    private AddressDomainService $addressDomainService, 
    private EntityManagerInterface $em,
    private AddressRepository $addressRepository
    )
  {
  }
  public function createAddress(CreateAddressRequest $createAddressRequest): AddressView
  {
    $address = $this->addressDomainService->createAddress($createAddressRequest);

    $this->em->persist($address);
    $this->em->flush();

    return Mapper::mapSingle($address, AddressView::class);
  }

  public function getAddress(int $addressId): AddressView
  {
    $address = $this->addressRepository->find($addressId);

    if (!$address instanceof Address) {
      throw new EntityNotFoundException('No address found with the provided id');
    }

    return Mapper::mapSingle($address, AddressView::class);
  }
}