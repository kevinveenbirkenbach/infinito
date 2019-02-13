<?php

namespace App\Domain\RequestManagement\User;

use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;

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
