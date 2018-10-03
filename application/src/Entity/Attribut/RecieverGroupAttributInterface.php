<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\RecieverGroupInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupAttributInterface
{
    public function setRecieverGroup(RecieverGroupInterface $recieverGroup): void;

    public function getRecieverGroup(): RecieverGroupInterface;
}
