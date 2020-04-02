<?php

namespace Infinito\Domain\Secure;

use Infinito\Domain\Request\Right\RequestedRightInterface;

/**
 * Allows to check if a RequestedRight is valid.
 *
 * @author kevinfrantz
 */
interface SecureRequestedRightCheckerServiceInterface
{
    /**
     * @return bool If Permission granted true
     */
    public function check(RequestedRightInterface $requestedRight): bool;
}
