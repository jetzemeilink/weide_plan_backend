<?php

namespace App\Tests\Factory;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Booking>
 *
 * @method static Booking|Proxy createOne(array $attributes = [])
 * @method static Booking[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Booking[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Booking|Proxy find(object|array|mixed $criteria)
 * @method static Booking|Proxy findOrCreate(array $attributes)
 * @method static Booking|Proxy first(string $sortedField = 'id')
 * @method static Booking|Proxy last(string $sortedField = 'id')
 * @method static Booking|Proxy random(array $attributes = [])
 * @method static Booking|Proxy randomOrCreate(array $attributes = [])
 * @method static Booking[]|Proxy[] all()
 * @method static Booking[]|Proxy[] findBy(array $attributes)
 * @method static Booking[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Booking[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static BookingRepository|RepositoryProxy repository()
 * @method Booking|Proxy create(array|callable $attributes = [])
 */
final class BookingFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
          
            'arrivalDate' => self::faker()->dateTime(),
            'departureDate' => self::faker()->dateTime(),
            'comment' => self::faker()->text(),
            'spot' => SpotFactory::createOne(),
            'campingEquipment' => CampingEquipmentFactory::createOne(),
            'guest' => GuestFactory::createOne()
        ];
    }

    protected static function getClass(): string
    {
        return Booking::class;
    }
}
