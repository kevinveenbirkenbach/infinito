<?php

namespace Infinito\Domain\SecureManagement;

use Infinito\Entity\Meta\RightInterface;
use Infinito\Exception\SourceAccessDenied;

/**
 * @author kevinfrantz
 */
interface SecureSourceCheckerInterface
{
    /**
     * @throws SourceAccessDenied
     *
     * @param RightInterface $right
     *
     * @return bool
     */
    public function hasPermission(RightInterface $requestedRight): bool;
}
