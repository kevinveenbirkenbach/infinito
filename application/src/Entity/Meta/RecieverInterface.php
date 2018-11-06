<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RightAttributInterface;
use App\Entity\Attribut\CollectionAttributInterface;

/**
 * It's neccessary to have an own reciever class, because if you would use a GroupSource it would lead to an infinite loop.
 *
 * @author kevinfrantz
 */
interface RecieverInterface extends MetaInterface, RightAttributInterface, CollectionAttributInterface
{
}
