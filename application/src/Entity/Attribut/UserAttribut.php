<?php

namespace App\Entity\Attribut;

use App\Entity\User;

/**
 * @author kevinfrantz
 */
trait UserAttribut
{
    /**
     * @var User
     */
    protected $user;

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
