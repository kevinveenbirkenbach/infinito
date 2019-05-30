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
     *
     * @return bool
     */
    public function hasPermission(RightInterface $requestedRight): bool;
}
