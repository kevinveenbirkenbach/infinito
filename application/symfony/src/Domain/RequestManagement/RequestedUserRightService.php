<?php

namespace App\Domain\RequestManagement;

use App\Domain\UserManagement\UserSourceDirectorServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedUserRightService extends RequestedUserRight implements RequestedUserRightServiceInterface
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
