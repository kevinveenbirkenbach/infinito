<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Right\RequestedRightInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightAttributInterface
{
    /**
     * @return bool
     */
    public function hasRequestedRight(): bool;

    /**
     * @param RequestedRightInterface $requestedRight
     */
    public function setRequestedRight(RequestedRightInterface $requestedRight): void;

    /**
     * @return RequestedRightInterface
     */
    public function getRequestedRight(): RequestedRightInterface;
}
