<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;

interface UserSourceDirectorInterface
{
    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;
}
