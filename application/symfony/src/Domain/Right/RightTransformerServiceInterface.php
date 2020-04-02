<?php

namespace Infinito\Domain\Right;

use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Entity\Meta\RightInterface;

/**
 * Allows to transform an Requested Right to a Entity Right.
 *
 * @author kevinfrantz
 */
interface RightTransformerServiceInterface
{
    public function transform(RequestedRightInterface $requestedRight): RightInterface;
}
