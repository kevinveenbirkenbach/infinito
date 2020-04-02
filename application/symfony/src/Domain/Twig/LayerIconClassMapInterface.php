<?php

namespace Infinito\Domain\Twig;

/**
 * Maps actions to classes.
 *
 * @author kevinfrantz
 */
interface LayerIconClassMapInterface
{
    public static function getIconClass(string $layer): string;
}
