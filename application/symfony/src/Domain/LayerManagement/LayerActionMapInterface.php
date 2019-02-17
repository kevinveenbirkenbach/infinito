<?php

namespace Infinito\Domain\LayerManagement;

/**
 * This LayerActionMap offers the possibility, to see which Action\Layer-Cobinations are possible.
 *
 * @author kevinfrantz
 */
interface LayerActionMapInterface
{
    /**
     * @param string $action
     *
     * @return array|string[]
     */
    public static function getLayers(string $action): array;

    /**
     * @param string $layer
     *
     * @return array|string[]
     */
    public static function getActions(string $layer): array;
}
