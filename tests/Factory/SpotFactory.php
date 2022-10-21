<?php

namespace App\Tests\Factory;

use App\Entity\Spot;
use App\Repository\SpotRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Spot>
 *
 * @method static Spot|Proxy createOne(array $attributes = [])
 * @method static Spot[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Spot[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Spot|Proxy find(object|array|mixed $criteria)
 * @method static Spot|Proxy findOrCreate(array $attributes)
 * @method static Spot|Proxy first(string $sortedField = 'id')
 * @method static Spot|Proxy last(string $sortedField = 'id')
 * @method static Spot|Proxy random(array $attributes = [])
 * @method static Spot|Proxy randomOrCreate(array $attributes = [])
 * @method static Spot[]|Proxy[] all()
 * @method static Spot[]|Proxy[] findBy(array $attributes)
 * @method static Spot[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Spot[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SpotRepository|RepositoryProxy repository()
 * @method Spot|Proxy create(array|callable $attributes = [])
 */
final class SpotFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'code' => self::faker()->text(),
            'size' => self::faker()->text(),
            'distanceElectricity' => self::faker()->text(),
            'isSeasonSpot' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Spot $spot): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Spot::class;
    }
}
