<?php

namespace Infinito\Domain\Layer;

/**
 * @author kevinfrantz
 */
interface LayerClassMapInterface
{
    /**
     * @return string The class which belongs to an Layer
     */
    public static function getClass(string $layer): string;
}
