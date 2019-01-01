<?php

namespace App\Domain\SecureManagement;

use App\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface SecureSourceCheckerInterface
{
    /**
     * @param RightInterface $right
     *
     * @return bool
     */
    public function hasPermission(RightInterface $requestedRight): bool;
}
