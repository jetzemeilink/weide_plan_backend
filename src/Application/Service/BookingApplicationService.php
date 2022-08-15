<?php

namespace App\Application\Service;

use App\Domain\Service\AddressDomainService;
use App\Domain\Service\BookingDomainService;
use App\Domain\Service\GuestDomainService;
use App\Entity\Booking;
use App\Entity\CampingEquipment;
use App\Entity\Spot;
use App\Repository\CampingEquipmentRepository;
use App\Repository\SpotRepository;
use App\Type\Request\CreateAddressRequest;
use App\Type\Request\CreateBookingRequest;
use App\Type\Request\CreateGuestRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class BookingApplicationService
{
    public function __construct(
        private SpotRepository $spotRepository,
        private BookingDomainService $bookingDomainService,
        private AddressDomainService $addressDomainService,
        private GuestDomainService $guestDomainService,
        private CampingEquipmentRepository $campingEquipmentRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function createBooking(
        CreateBookingRequest $createBookingRequest,
        CreateGuestRequest $createGuestRequest,
        CreateAddressRequest $createAddressRequest
    ): Booking
    {
        $spot = $this->spotRepository->findOneBy(['code' => $createBookingRequest->spotCode]);
        $campingEquipment = $this->campingEquipmentRepository->findOneBy(['code' => $createBookingRequest->campingEquipmentCode]);
        $address = $this->addressDomainService->createAddress($createAddressRequest);
        $guest = $this->guestDomainService->createGuest($createGuestRequest, $address);


        if (!$spot instanceof Spot) {
            throw new EntityNotFoundException("No know spot found with provided id");
        }

        if (!$campingEquipment instanceof CampingEquipment) {
            throw new EntityNotFoundException("No know camping equipment found with provided id");
        }

        $this->em->beginTransaction();

        try {
            $booking = $this->bookingDomainService->createBooking($createBookingRequest,$spot, $guest, $campingEquipment);

            $this->em->persist($booking);
            $this->em->flush();
            $this->em->commit();

            return $booking;
        } catch(Exception $e) {
            $this->em->getConnection()->rollBack();

            throw $e;
        }
    }
}