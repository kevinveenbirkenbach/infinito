<?php

namespace App\Domain\RequestManagement\Action;

use App\Domain\RequestManagement\User\RequestedUserServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedActionService extends RequestedAction implements RequestedActionServiceInterface
{
    /**
     * @param RequestedUserServiceInterface $requestedUserService
     */
    public function __construct(RequestedUserServiceInterface $requestedUserService)
    {
        parent::__construct($requestedUserService);
    }
}
