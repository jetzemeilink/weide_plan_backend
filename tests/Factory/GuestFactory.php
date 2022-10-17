<?php

namespace App\Tests\Factory;

use App\Entity\Guest;
use App\Repository\GuestRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Guest>
 *
 * @method static Guest|Proxy createOne(array $attributes = [])
 * @method static Guest[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Guest[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Guest|Proxy find(object|array|mixed $criteria)
 * @method static Guest|Proxy findOrCreate(array $attributes)
 * @method static Guest|Proxy first(string $sortedField = 'id')
 * @method static Guest|Proxy last(string $sortedField = 'id')
 * @method static Guest|Proxy random(array $attributes = [])
 * @method static Guest|Proxy randomOrCreate(array $attributes = [])
 * @method static Guest[]|Proxy[] all()
 * @method static Guest[]|Proxy[] findBy(array $attributes)
 * @method static Guest[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Guest[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static GuestRepository|RepositoryProxy repository()
 * @method Guest|Proxy create(array|callable $attributes = [])
 */
final class GuestFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => self::faker()->text(),
            'numberOfPax' => self::faker()->randomNumber(),
            'hasDog' => self::faker()->boolean(),
        ];
    }

    protected static function getClass(): string
    {
        return Guest::class;
    }
}
