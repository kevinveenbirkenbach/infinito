<?php

namespace Infinito\Domain\Twig;

/**
 * Maps actions to classes.
 *
 * @author kevinfrantz
 */
interface ActionIconClassMapInterface
{
    /**
     * @param string $action
     *
     * @return string
     */
    public function getIconClass(string $action): string;
}
