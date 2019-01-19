<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;

/**
 * Offers based on an user variable a user with a source.
 *
 * @author kevinfrantz
 */
interface UserSourceDirectorInterface
{
    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;
}
