<?php

namespace Infinito\Domain\RequestManagement\Action;

use Infinito\Domain\RequestManagement\User\RequestedUserServiceInterface;

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
