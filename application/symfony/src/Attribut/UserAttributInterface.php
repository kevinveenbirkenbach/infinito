<?php

namespace App\Attribut;

use App\Entity\UserInterface;

/**
 * @author kevinfrantz
 */
interface UserAttributInterface
{
    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user): void;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return bool Returns if a user is set
     */
    public function hasUser(): bool;
}
