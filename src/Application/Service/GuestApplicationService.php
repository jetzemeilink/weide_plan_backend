<?php

namespace App\Application\Service;

use App\Domain\Service\GuestDomainService;
use App\Entity\Address;
use App\Entity\Guest;
use App\Repository\AddressRepository;
use App\Shared\Helpers\Mapper;
use App\Type\Request\CreateGuestRequest;
use App\Type\View\GuestView;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GuestApplicationService
{

  public function __construct(
    private EntityManagerInterface $em, 
    private AddressRepository $addressRepository, 
    private GuestDomainService $guestDomainService
    )
  {
  }

  public function createGuest(CreateGuestRequest $createGuestRequest): GuestView
  {
    $address = $this->addressRepository->find($createGuestRequest->addressId);

    if (!$address instanceof Address) {
      throw new EntityNotFoundException('No addres found with provided id');
    }

    $this->em->beginTransaction();

    try {
      $guest = $this->guestDomainService->createGuest($createGuestRequest, $address);

      $this->em->commit($guest);
      $this->em->flush();

      return Mapper::mapSingle($guest, Guest::class);
    } catch(Exception $error) {
        $this->em->rollback();

        throw $error;
    }
  }
}