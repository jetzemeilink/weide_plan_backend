<?php

namespace App\Tests\Factory;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Address>
 *
 * @method static Address|Proxy createOne(array $attributes = [])
 * @method static Address[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Address[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Address|Proxy find(object|array|mixed $criteria)
 * @method static Address|Proxy findOrCreate(array $attributes)
 * @method static Address|Proxy first(string $sortedField = 'id')
 * @method static Address|Proxy last(string $sortedField = 'id')
 * @method static Address|Proxy random(array $attributes = [])
 * @method static Address|Proxy randomOrCreate(array $attributes = [])
 * @method static Address[]|Proxy[] all()
 * @method static Address[]|Proxy[] findBy(array $attributes)
 * @method static Address[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Address[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AddressRepository|RepositoryProxy repository()
 * @method Address|Proxy create(array|callable $attributes = [])
 */
final class AddressFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            'street' => self::faker()->streetName(),
            'city' => self::faker()->city(),
            'zipCode' => self::faker()->postcode()
        ];
    }

    protected static function getClass(): string
    {
        return Address::class;
    }
}
