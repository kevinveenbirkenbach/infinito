<?php

namespace Infinito\Domain\Secure;

use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface SecureSourceCheckerInterface
{
    /**
     * @param RightInterface $right
     */
    public function hasPermission(RightInterface $requestedRight): bool;
}
