<?php

namespace App\Domain\RequestManagement\Action;

use App\Domain\RequestManagement\User\RequestedUserServiceInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 */
final class RequestedActionService extends RequestedAction implements RequestedActionServiceInterface
{
    /**
     * @todo Optimize this constructor! The UserSourceDirector is not used in this class!
     *
     * @param UserSourceDirectorInterface   $userSourceDirector
     * @param RequestedUserServiceInterface $requestedUserService
     */
    public function __construct(UserSourceDirectorInterface $userSourceDirector, RequestedUserServiceInterface $requestedUserService)
    {
        parent::__construct($userSourceDirector, $requestedUserService);
    }
}
