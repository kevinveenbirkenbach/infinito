<?php

namespace Infinito\Domain\UserManagement;

use Infinito\Entity\UserInterface;

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
