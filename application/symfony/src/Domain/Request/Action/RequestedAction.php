<?php

namespace Infinito\Domain\Request\Action;

use Infinito\Domain\Request\User\RequestedUser;
use Infinito\Domain\Request\User\RequestedUserInterface;

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
