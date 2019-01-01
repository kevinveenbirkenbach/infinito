<?php

namespace App\Domain\SecureManagement;

use App\Entity\Meta\RightInterface;
use App\Exception\SourceAccessDenied;

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
