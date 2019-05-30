<?php

namespace Infinito\Domain\Layer;

/**
 * @author kevinfrantz
 */
interface LayerInterfaceMapInterface
{
    /**
     * @return array|string[] All layer interfaces
     */
    public static function getAllInterfaces(): array;

    /**
     * @param string $layer
     *
     * @return string The interface which belongs to an Layer
     */
    public static function getInterface(string $layer): string;
}
