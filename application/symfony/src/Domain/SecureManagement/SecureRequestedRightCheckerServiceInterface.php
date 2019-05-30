<?php

namespace Infinito\Domain\SecureManagement;

use Infinito\Domain\Request\Right\RequestedRightInterface;

/**
 * Allows to check if a RequestedRight is valid.
 *
 * @author kevinfrantz
 */
interface SecureRequestedRightCheckerServiceInterface
{
    /**
     * @param RequestedRightInterface $requestedRight
     *
     * @return bool If Permission granted true
     */
    public function check(RequestedRightInterface $requestedRight): bool;
}
