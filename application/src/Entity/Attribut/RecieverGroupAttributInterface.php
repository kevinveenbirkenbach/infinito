<?php

namespace App\Entity\Attribut;

use App\Entity\RecieverGroupInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupAttributInterface
{
    public function setRecieverGroup(RecieverGroupInterface $recieverGroup): void;

    public function getRecieverGroup(): RecieverGroupInterface;
}
