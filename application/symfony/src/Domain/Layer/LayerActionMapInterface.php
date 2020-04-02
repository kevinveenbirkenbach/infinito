<?php

namespace Infinito\Domain\Layer;

/**
 * This LayerActionMap offers the possibility, to see which Action\Layer-Cobinations are possible.
 *
 * @author kevinfrantz
 */
interface LayerActionMapInterface
{
    /**
     * @return array|string[]
     */
    public static function getLayers(string $action): array;

    /**
     * @return array|string[]
     */
    public static function getActions(string $layer): array;
}
