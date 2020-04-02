<?php

namespace Infinito\Domain\Request\User;

use Infinito\Domain\Request\Right\RequestedRightServiceInterface;
use Infinito\Domain\User\UserSourceDirectorServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedUserService extends RequestedUser implements RequestedUserServiceInterface
{
    public function __construct(UserSourceDirectorServiceInterface $userSourceDirectorService, RequestedRightServiceInterface $requestedRightService)
    {
        parent::__construct($userSourceDirectorService, $requestedRightService);
    }
}
