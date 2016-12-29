<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeletonTest;

final class TestUtils
{
    public static function getPropertyThroughReflection($obj, string $propertyName)
    {
        $reflectionObject = new \ReflectionObject($obj);
        $property = $reflectionObject->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
