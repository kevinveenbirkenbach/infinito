<?php

namespace Infinito\Domain\Twig;

/**
 * Maps actions to classes.
 *
 * @author kevinfrantz
 */
interface ActionIconClassMapInterface
{
    public function getIconClass(string $action): string;
}
