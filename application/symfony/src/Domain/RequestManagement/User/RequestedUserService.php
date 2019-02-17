<?php

namespace Infinito\Domain\RequestManagement\User;

use Infinito\Domain\UserManagement\UserSourceDirectorServiceInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedUserService extends RequestedUser implements RequestedUserServiceInterface
{
    /**
     * @param UserSourceDirectorServiceInterface $userSourceDirectorService
     * @param RequestedRightServiceInterface     $requestedRightService
     */
    public function __construct(UserSourceDirectorServiceInterface $userSourceDirectorService, RequestedRightServiceInterface $requestedRightService)
    {
        parent::__construct($userSourceDirectorService, $requestedRightService);
    }
}
