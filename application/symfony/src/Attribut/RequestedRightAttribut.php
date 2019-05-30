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

    /**
     * @param RequestedRightInterface $requestedRight
     */
    public function setRequestedRight(RequestedRightInterface $requestedRight): void
    {
        $this->requestedRight = $requestedRight;
    }

    /**
     * @return bool
     */
    public function hasRequestedRight(): bool
    {
        return isset($this->requestedRight);
    }

    /**
     * @return RequestedRightInterface
     */
    public function getRequestedRight(): RequestedRightInterface
    {
        return $this->requestedRight;
    }
}
