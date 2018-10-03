<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\UserSourceInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceAttributInterface
{
    public function setUserSource(UserSourceInterface $user): void;

    public function getUserSource(): UserSourceInterface;
}
