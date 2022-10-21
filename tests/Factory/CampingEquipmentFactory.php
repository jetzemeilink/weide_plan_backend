<?php

namespace App\Tests\Factory;

use App\Entity\CampingEquipment;
use App\Repository\CampingEquipmentRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<CampingEquipment>
 *
 * @method static CampingEquipment|Proxy createOne(array $attributes = [])
 * @method static CampingEquipment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CampingEquipment[]|Proxy[] createSequence(array|callable $sequence)
 * @method static CampingEquipment|Proxy find(object|array|mixed $criteria)
 * @method static CampingEquipment|Proxy findOrCreate(array $attributes)
 * @method static CampingEquipment|Proxy first(string $sortedField = 'id')
 * @method static CampingEquipment|Proxy last(string $sortedField = 'id')
 * @method static CampingEquipment|Proxy random(array $attributes = [])
 * @method static CampingEquipment|Proxy randomOrCreate(array $attributes = [])
 * @method static CampingEquipment[]|Proxy[] all()
 * @method static CampingEquipment[]|Proxy[] findBy(array $attributes)
 * @method static CampingEquipment[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static CampingEquipment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CampingEquipmentRepository|RepositoryProxy repository()
 * @method CampingEquipment|Proxy create(array|callable $attributes = [])
 */
final class CampingEquipmentFactory extends ModelFactory
{
    private static $codes = [
        CampingEquipment::CAMPER_ELECTRIC, CampingEquipment::CAMPER_NOT_ELECTRIC, CampingEquipment::CARAVAN_ELECTRIC, 
        CampingEquipment::CARAVAN_NOT_ELECTRIC, CampingEquipment::TENT_ELECTRIC, CampingEquipment::TENT_NOT_ELECTRIC];

    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->randomElement(self::$codes),
            'description' => self::faker()->text(),
            'hasElectricity' => self::faker()->boolean(),
        ];
    }

    protected static function getClass(): string
    {
        return CampingEquipment::class;
    }
}
