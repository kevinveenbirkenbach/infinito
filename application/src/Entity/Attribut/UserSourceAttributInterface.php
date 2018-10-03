<?php

namespace App\Entity\Attribut;

use App\Entity\Source\UserSourceInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceAttributInterface
{
    public function setUserSource(UserSourceInterface $user): void;

    public function getUserSource(): UserSourceInterface;
}
