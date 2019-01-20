<?php

namespace App\Attribut;

use App\Entity\User;
use App\Entity\UserInterface;

/**
 * @author kevinfrantz
 */
trait UserAttribut
{
    /**
     * @var User
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
}
