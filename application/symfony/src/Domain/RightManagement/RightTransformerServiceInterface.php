<?php

namespace App\Domain\RightManagement;

use App\Entity\Meta\RightInterface;
use App\Domain\RequestManagement\Right\RequestedRightInterface;

/**
 * Allows to transform an Requested Right to a Entity Right.
 *
 * @author kevinfrantz
 */
interface RightTransformerServiceInterface
{
    /**
     * @param RequestedRightInterface $requestedRight
     *
     * @return RightInterface
     */
    public function transform(RequestedRightInterface $requestedRight): RightInterface;
}
