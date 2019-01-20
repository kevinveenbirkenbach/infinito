<?php

namespace App\Domain\RequestManagement\Action;

use App\Domain\RequestManagement\Right\RequestedRightServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedActionService extends RequestedAction implements RequestedActionServiceInterface
{
    /**
     * @param RequestedRightServiceInterface $requestedRightService
     */
    public function __construct(RequestedRightServiceInterface $requestedRightService)
    {
        parent::__construct($requestedRightService);
    }
}
