<?php

namespace App\Domain\RightManagement;

use App\Entity\Meta\RightInterface;
use App\Domain\RequestManagement\Right\RequestedRight;

/**
 * Allows to transform an Requested Right to a Entity Right.
 *
 * @author kevinfrantz
 */
interface RightTransformerServiceInterface
{
    /**
     * @param RequestedRight $requestedRight
     *
     * @return RightInterface
     */
    public function transform(RequestedRight $requestedRight): RightInterface;
}
