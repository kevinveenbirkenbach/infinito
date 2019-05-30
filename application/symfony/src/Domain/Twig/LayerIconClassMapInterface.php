<?php

namespace Infinito\Domain\Twig;

/**
 * Maps actions to classes.
 *
 * @author kevinfrantz
 */
interface LayerIconClassMapInterface
{
    /**
     * @param string $layer
     *
     * @return string
     */
    public static function getIconClass(string $layer): string;
}
