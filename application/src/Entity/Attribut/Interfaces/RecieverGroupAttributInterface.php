<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\Interfaces\RecieverGroupInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupAttributInterface
{
    public function setRecieverGroup(RecieverGroupInterface $recieverGroup): void;

    public function getRecieverGroup(): RecieverGroupInterface;
}
