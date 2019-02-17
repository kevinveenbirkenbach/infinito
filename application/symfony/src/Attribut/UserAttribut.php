<?php

namespace Infinito\Attribut;

use Infinito\Entity\User;
use Infinito\Entity\UserInterface;

/**
 * @author kevinfrantz
 *
 * @see UserAttributInterface
 */
trait UserAttribut
{
    /**
     * @var User|null
     */
    protected $user;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function hasUser(): bool
    {
        return isset($this->user);
    }
}
