<?php

namespace Infinito\Domain\TwigManagement;

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
