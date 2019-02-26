<?php

namespace Infinito\Domain\RequestManagement\Action;

use Infinito\Domain\RequestManagement\User\RequestedUser;
use Infinito\Domain\RequestManagement\User\RequestedUserInterface;

/**
 * @author kevinfrantz
 */
class RequestedAction extends RequestedUser implements RequestedActionInterface
{
    /**
     * @param RequestedUserInterface $requestedUser
     */
    public function __construct(RequestedUserInterface $requestedUser)
    {
        parent::__construct($requestedUser->getUserSourceDirector(), $requestedUser);
    }
}
