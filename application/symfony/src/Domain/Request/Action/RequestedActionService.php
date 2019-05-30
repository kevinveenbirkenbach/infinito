<?php

namespace Infinito\Domain\Request\Action;

use Infinito\Domain\Request\User\RequestedUserServiceInterface;

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
