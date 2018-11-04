<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\RecieverInterface;

/**
 * @author kevinfrantz
 */
interface RecieverAttributInterface
{
    public function setReciever(RecieverInterface $reciever): void;

    public function getReciever(): RecieverInterface;
}
