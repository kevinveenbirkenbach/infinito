<?php

namespace Infinito\Attribut;

use Infinito\Entity\UserInterface;

/**
 * @author kevinfrantz
 */
interface UserAttributInterface
{
    /**
     * @var string
     */
    public const USER_ATTRIBUT_NAME = 'user';

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
