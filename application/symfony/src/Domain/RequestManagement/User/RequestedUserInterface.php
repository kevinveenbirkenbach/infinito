<?php

namespace Infinito\Domain\RequestManagement\User;

use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * Offers a Service for managing the rights.
 *
 * @author kevinfrantz
 */
interface RequestedUserInterface extends RequestedRightInterface
{
    /**
     * @return UserSourceDirectorInterface
     */
    public function getUserSourceDirector(): UserSourceDirectorInterface;
}
