<?php

namespace App\Shared\Helpers;

use Doctrine\ORM\EntityNotFoundException;
use ReflectionProperty;

class Mapper
{
    public static function mapSingle(mixed $entity, mixed $viewClass): mixed
    {
        if (!class_exists($viewClass)) {
            throw new EntityNotFoundException('View does not exist');
        }

        $view = new $viewClass();

        return self::populateView($view, $entity);
    }

    private static function populateView(mixed $view, mixed $entity): mixed
    {
        $entityProperties = get_object_vars($view);

        foreach ($entityProperties as $property => $value) {

            $possibleNestedView = new ReflectionProperty($view, $property);
            $propertyValue = self::getPropertyValue($entity, $property);

            if (class_exists($possibleNestedView->getType()->getName()) && $propertyValue !== null) {
                $nestedView = new ($possibleNestedView->getType()->getName());

                $view->$property = self::populateView($nestedView, $propertyValue);
            } else {
                $view->$property = $propertyValue;
            }
        }

        return $view;
    }

    private static function getPropertyValue(mixed $entity, string $property): mixed
    {
        if (method_exists($entity, 'get' . ucfirst($property))) {
            $method =  'get' . ucfirst($property);

            return $entity->$method();
        }

        if (method_exists($entity, 'has' . ucfirst($property))) {
            $method = 'has' . ucfirst($property);

            return $entity->$method();
        }

        return null;
    }
}