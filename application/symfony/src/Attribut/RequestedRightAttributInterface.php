<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Right\RequestedRightInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightAttributInterface
{
    public function hasRequestedRight(): bool;

    public function setRequestedRight(RequestedRightInterface $requestedRight): void;

    public function getRequestedRight(): RequestedRightInterface;
}
