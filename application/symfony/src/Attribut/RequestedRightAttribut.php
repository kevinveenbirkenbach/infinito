<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Right\RequestedRightInterface;

/**
 * @author kevinfrantz
 *
 * @see RequestedRightAttributInterface
 */
trait RequestedRightAttribut
{
    /**
     * @var RequestedRightInterface
     */
    protected $requestedRight;

    public function setRequestedRight(RequestedRightInterface $requestedRight): void
    {
        $this->requestedRight = $requestedRight;
    }

    public function hasRequestedRight(): bool
    {
        return isset($this->requestedRight);
    }

    public function getRequestedRight(): RequestedRightInterface
    {
        return $this->requestedRight;
    }
}
