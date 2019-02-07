<?php

namespace App\Domain\FixtureManagement;

use HaydenPierce\ClassFinder\ClassFinder;
use App\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface;

/**
 * @author kevinfrantz
 */
final class FixtureSourceFactory implements FixtureSourceFactoryInterface
{
    const FIXTURE_SOURCE_NAMESPACE = 'App\Domain\FixtureManagement\FixtureSource';

    /**
     * @return array|FixtureSourceInterface[]
     */
    private static function getAllClassesInSourceFixtureNamespace(): array
    {
        return ClassFinder::getClassesInNamespace(self::FIXTURE_SOURCE_NAMESPACE);
    }

    /**
     * @param array $unfilteredClasses|FixtureSourceInterface[]
     *
     * @return array|FixtureSourceInterface[] Returns just the classes which are final
     */
    private static function filterFinal(array $unfilteredClasses): array
    {
        $filtered = [];
        foreach ($unfilteredClasses as $unfilteredClass) {
            $unfilteredClassReflection = new \ReflectionClass($unfilteredClass);
            if ($unfilteredClassReflection->isFinal()) {
                $filtered[] = $unfilteredClass;
            }
        }

        return $filtered;
    }

    /**
     * @param array $classes|FixtureSourceInterface[]
     *
     * @return array|FixtureSourceInterface[]
     */
    private static function loadObjects(array $classes): array
    {
        $objects = [];
        foreach ($classes as $class) {
            $objects[] = new $class();
        }

        return $objects;
    }

    /**
     * @return array
     */
    public static function getAllFixtureSources(): array
    {
        $unfilteredClasses = self::getAllClassesInSourceFixtureNamespace();
        $filtered = self::filterFinal($unfilteredClasses);
        $objects = self::loadObjects($filtered);

        return $objects;
    }
}
