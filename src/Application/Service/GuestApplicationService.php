<?php

namespace App\Application\Service;

use App\Domain\Service\GuestDomainService;
use App\Entity\Address;
use App\Entity\Guest;
use App\Repository\AddressRepository;
use App\Repository\GuestRepository;
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
    private GuestRepository $guestRepository,
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
      $guest = $this->guestDomainService->createGuest($createGuestRequest);

      $guest->setAddress($address);

      $this->em->commit($guest);
      $this->em->flush();

      return Mapper::mapSingle($guest, GuestView::class);
    } catch(Exception $error) {
        $this->em->rollback();

        throw $error;
    }
  }

  public function getGuest(int $guestId): GuestView
  {
    $guest = $this->guestRepository->find($guestId);
  
    if (!$guest instanceof Guest) {
      throw new EntityNotFoundException('No guest found with the provided id');
    }

    return Mapper::mapSingle($guest, GuestView::class);
  }
}