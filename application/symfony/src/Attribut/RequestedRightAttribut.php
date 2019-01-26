<?php

namespace App\Attribut;

use App\Domain\RequestManagement\Right\RequestedRightInterface;

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
     * @return RequestedRightInterface
     */
    public function getRequestedRight(): RequestedRightInterface
    {
        return $this->requestedRight;
    }
}
