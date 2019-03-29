<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

/**
 * Classes which inhiere from this class and should be loaded by SourceFixtures MUST be declared as final.
 *
 * @author kevinfrantz
 */
abstract class AbstractFixtureSource implements FixtureSourceInterface
{
    /**
     * @return string
     */
    public static function getSlug(): string
    {
        $className = get_called_class();
        $exploded = explode('\\', $className);
        $shortname = $exploded[count($exploded) - 1];
        $key = str_replace('FixtureSource', '', $shortname);
        $lower = strtolower($key);

        return $lower;
    }
}
