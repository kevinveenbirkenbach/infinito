<?php

namespace Infinito\Domain\Request\User;

use Infinito\Domain\User\UserSourceDirectorServiceInterface;
use Infinito\Domain\Request\Right\RequestedRightServiceInterface;

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
