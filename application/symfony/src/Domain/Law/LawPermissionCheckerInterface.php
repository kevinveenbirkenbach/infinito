<?php

namespace Infinito\Domain\Law;

use Infinito\Entity\Meta\RightInterface;

/**
 * Allows to check if a right has permission by a law.
 *
 * @author kevinfrantz
 */
interface LawPermissionCheckerInterface
{
    /**
     * Checks if the client has the right for executing.
     *
     * @return bool
     */
    public function hasPermission(RightInterface $clientRight): bool;
}
