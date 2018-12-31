<?php

namespace App\Domain\LawManagement;

use App\Entity\Meta\RightInterface;

/**
 * Allows to check if a source has rights on a source.
 *
 * @author kevinfrantz
 */
interface LawPermissionCheckerServiceInterface
{
    /**
     * Checks if the client has the right for executing.
     *
     * @return bool
     */
    public function hasPermission(RightInterface $clientRight): bool;
}
