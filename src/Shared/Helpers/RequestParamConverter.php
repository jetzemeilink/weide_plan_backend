<?php

namespace App\Shared\Helpers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestParamConverter implements ParamConverterInterface
{
    const REQUEST_NAMESPACE = 'App\Type\Request\\';

    public function apply(Request $request, ParamConverter $configuration): void
    {
        if (in_array('multiple', $configuration->getOptions())) {
            $classes = explode('|', $configuration->getClass());

            foreach ($classes as $class) {
                $populatedClass = $this->populateClass($class, $request->request->all());

                $request->attributes->set(lcfirst($class), $populatedClass);
            }

            return;
        }

        $class = $this->populateClass($configuration->getClass(), $request->request->all());

        $request->attributes->set(lcfirst($configuration->getClass()), $class);
    }

    private function populateClass(mixed $class, $requestProperties ): mixed
    {
        $requestedClass = self::REQUEST_NAMESPACE . $class;
        $classInstance = new $requestedClass();

        foreach ($requestProperties as $property => $value) {

            if (property_exists($classInstance, $property)) {
                $classInstance->$property = $value;
            }
        }

        return $classInstance;
    }

    public function supports(ParamConverter $configuration): bool
    {
        if (in_array('multiple', $configuration->getOptions())) {
            $classes = explode('|', $configuration->getClass());

            foreach ($classes as $class) {
                if (!class_exists( self::REQUEST_NAMESPACE . $class)) {
                    return false;
                }
            }

            return true;
        }

        return class_exists( self::REQUEST_NAMESPACE .  $configuration->getClass());
    }
}