<?php

namespace Infinito\Domain\User;

use Infinito\Entity\UserInterface;

/**
 * Offers based on an user variable a user with a source.
 *
 * @author kevinfrantz
 */
interface UserSourceDirectorInterface
{
    public function getUser(): UserInterface;
}
