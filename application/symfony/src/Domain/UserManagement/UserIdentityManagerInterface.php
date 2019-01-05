<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;

interface UserIdentityManagerInterface
{
    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;
}
