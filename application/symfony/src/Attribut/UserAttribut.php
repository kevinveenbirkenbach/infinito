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

    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function hasUser(): bool
    {
        return isset($this->user);
    }
}
