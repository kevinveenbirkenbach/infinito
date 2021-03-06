<?php

namespace Infinito\Domain\Fixture;

use HaydenPierce\ClassFinder\ClassFinder;
use Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface;

/**
 * @author kevinfrantz
 */
final class FixtureSourceFactory implements FixtureSourceFactoryInterface
{
    /**
     * @var string Namespace in which the fixture sources are saved
     */
    private const FIXTURE_SOURCE_NAMESPACE = 'Infinito\Domain\Fixture\FixtureSource';

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
            $object = new $class();
            $objects[$object->getSlug()] = $object;
        }

        return $objects;
    }

    public static function getAllFixtureSources(): array
    {
        $unfilteredClasses = self::getAllClassesInSourceFixtureNamespace();
        $filtered = self::filterFinal($unfilteredClasses);
        $objects = self::loadObjects($filtered);

        return $objects;
    }
}
