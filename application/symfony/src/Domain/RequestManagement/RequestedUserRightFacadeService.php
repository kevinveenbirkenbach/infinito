<?php

namespace App\Domain\RequestManagement;

use App\Domain\UserManagement\UserSourceDirectorServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedUserRightFacadeService extends RequestedUserRightFacade implements RequestedUserRightFacadeServiceInterface
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
