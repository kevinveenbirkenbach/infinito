<?php

namespace Infinito\Domain\Secure;

use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface SecureSourceCheckerInterface
{
    public function hasPermission(RightInterface $right): bool;
}
