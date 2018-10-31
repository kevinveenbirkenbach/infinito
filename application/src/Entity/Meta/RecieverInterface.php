<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembersAttributInterface;

/**
 * It's neccessary to have an own reciever class, because if you would use a GroupSource it would lead to an infinite loop.
 *
 * @author kevinfrantz
 */
interface RecieverInterface extends RelationAttributInterface, MetaInterface, MembersAttributInterface
{
}
