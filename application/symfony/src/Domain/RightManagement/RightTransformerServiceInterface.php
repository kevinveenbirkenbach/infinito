<?php

namespace Infinito\Domain\RightManagement;

use Infinito\Entity\Meta\RightInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;

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
