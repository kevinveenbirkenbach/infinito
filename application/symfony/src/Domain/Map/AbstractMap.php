<?php

namespace Infinito\Domain\Map;

/**
 * This class offers the basic functions for managing an 2 dimensional map.
 *
 * @author kevinfrantz
 */
abstract class AbstractMap implements MapInterface
{
    /**
     * @param string         $index
     * @param array|string[] $map
     *
     * @return array|string[]
     */
    protected static function getValuesByIndex(string $index, array $map): array
    {
        if (array_key_exists($index, $map)) {
            return $map[$index];
        }

        return [];
    }

    /**
     * @param string         $value
     * @param array|string[] $map
     *
     * @return array|string[]
     */
    protected static function getIndizesByValue(string $value, array $map): array
    {
        $result = [];
        foreach ($map as $index => $values) {
            if (in_array($value, $values)) {
                $result[] = $index;
            }
        }

        return $result;
    }
}
