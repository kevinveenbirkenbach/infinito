<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\Interfaces\UserInterface;

/**
 * @author kevinfrantz
 */
interface UserAttributInterface
{
    public function setUser(UserInterface $user): void;

    public function getUser(): UserInterface;
}
