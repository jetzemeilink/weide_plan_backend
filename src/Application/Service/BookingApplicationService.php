<?php

namespace App\Application\Service;

use App\Domain\Service\AddressDomainService;
use App\Domain\Service\BookingDomainService;
use App\Domain\Service\GuestDomainService;
use App\Entity\Address;
use App\Entity\CampingEquipment;
use App\Entity\Guest;
use App\Entity\Spot;
use App\Repository\AddressRepository;
use App\Repository\CampingEquipmentRepository;
use App\Repository\GuestRepository;
use App\Repository\SpotRepository;
use App\Type\Request\CreateBookingRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;
use App\Shared\Helpers\Mapper;
use App\Type\View\BookingView;

class BookingApplicationService
{
    public function __construct(
        private SpotRepository $spotRepository,
        private BookingDomainService $bookingDomainService,
        private AddressDomainService $addressDomainService,
        private AddressRepository $addressRepository,
        private GuestDomainService $guestDomainService,
        private GuestRepository $guestRepository,
        private CampingEquipmentRepository $campingEquipmentRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function createBooking(
        CreateBookingRequest $createBookingRequest,
        int $guestId,
        int $addressId
    ): BookingView
    {
        $spot = $this->spotRepository->findOneBy(['code' => $createBookingRequest->spotCode]);
        $campingEquipment = $this->campingEquipmentRepository->findOneBy(['code' => $createBookingRequest->campingEquipmentCode]);
        $address = $this->addressRepository->find($addressId);
        $guest = $this->guestRepository->find($guestId);

        if (!$guest instanceof Guest) {
            throw new EntityNotFoundException("No guest found with provided id");
        }

        if (!$address instanceof Address) {
            throw new EntityNotFoundException("No address found with provided id");
        }

        if (!$spot instanceof Spot) {
            throw new EntityNotFoundException("No spot found with provided id");
        }

        if (!$campingEquipment instanceof CampingEquipment) {
            throw new EntityNotFoundException("No camping equipment found with provided id");
        }

        $this->em->beginTransaction();

        try {
            $booking = $this->bookingDomainService->createBooking($createBookingRequest,$spot, $guest, $campingEquipment);

            $booking->setSpot($spot)
            ->setGuest($guest)
            ->setCampingEquipment($campingEquipment);

            $this->em->persist($booking);
            $this->em->flush();
            $this->em->commit();

            return Mapper::mapSingle($booking, BookingView::class);
        } catch(Exception $e) {
            $this->em->getConnection()->rollBack();

            throw $e;
        }
    }
}