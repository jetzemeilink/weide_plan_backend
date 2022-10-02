<?php

namespace App\Resolver\ResolverMap;

use App\Repository\BookingRepository;
use App\Repository\GuestRepository;
use App\Repository\PaymentMethodRepository;
use App\Repository\SpotRepository;
use App\Type\Enum\ResolverEnum;
use GraphQL\Type\Definition\ResolveInfo;
use JetBrains\PhpStorm\ArrayShape;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;

class MainResolver extends ResolverMap
{
    public function __construct(
        private BookingRepository $bookingRepository,
        private GuestRepository $guestRepository,
        private SpotRepository $spotRepository,
        private PaymentMethodRepository $paymentMethodRepository
    )    {}

    /**
     * @inheritDoc
     */
    #[ArrayShape(["RootQuery" => "\Closure[]"])]
    protected function map(): array
    {
        return [
            "RootQuery" => [
            self::RESOLVE_FIELD => function($value, ArgumentInterface $args, \ArrayObject $context, ResolveInfo $info) {

                return match ($info->fieldName) {
                    ResolverEnum::Booking->value => $this->bookingRepository->find($args['id']),
                    ResolverEnum::Bookings->value => $this->bookingRepository->findAll(),
                    ResolverEnum::Guest->value => $this->guestRepository->find($args['id']),
                    ResolverEnum::Guests->value => $this->guestRepository->findAll(),
                    ResolverEnum::Spot->value => $this->spotRepository->find($args['id']),
                    ResolverEnum::Spots->value => $this->spotRepository->findAll(),
                    ResolverEnum::PaymentMethods->value => $this->paymentMethodRepository->findAll(),
                    ResolverEnum::PaymentMethod->value => $this->paymentMethodRepository->find($args['id']),
                    default => null
                };
            }

        ]];

    }
}