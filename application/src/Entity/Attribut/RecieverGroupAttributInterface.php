<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\RecieverGroupInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupAttributInterface
{
    public function setRecieverGroup(RecieverGroupInterface $recieverGroup): void;

    public function getRecieverGroup(): RecieverGroupInterface;
}
