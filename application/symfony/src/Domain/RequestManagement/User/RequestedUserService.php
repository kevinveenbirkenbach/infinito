<?php

namespace App\Domain\RequestManagement\User;

use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\Domain\RequestManagement\Right\RequestedRightServiceInterface;

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
