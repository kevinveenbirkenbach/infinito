<?php

namespace App\Domain\SecureManagement;

use App\Domain\RequestManagement\Right\RequestedRightInterface;

/**
 * Allows to check if a RequestedRight is valid.
 *
 * @author kevinfrantz
 */
interface SecureRequestedRightCheckerInterface
{
    /**
     * @param RequestedRightInterface $requestedRight
     *
     * @return bool If Permission granted true
     */
    public function check(RequestedRightInterface $requestedRight): bool;
}
