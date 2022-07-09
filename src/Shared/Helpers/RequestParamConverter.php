<?php

namespace App\Shared\Helpers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestParamConverter implements ParamConverterInterface
{
    const REQUEST_NAMESPACE = 'App\Type\Request\\';

    public function apply(Request $request, ParamConverter $configuration): mixed
    {
        $requestedClass = self::REQUEST_NAMESPACE . $configuration->getClass();
        $class = new $requestedClass();

        foreach ($request->request->all() as $property => $value) {

            if (property_exists($class, $property)) {
                $class->$property = $value;
            }
        }

        return $class;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return class_exists( self::REQUEST_NAMESPACE .  $configuration->getClass());
    }
}