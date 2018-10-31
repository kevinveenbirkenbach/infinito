<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembersAttributInterface;

/**
 * @author kevinfrantz
 */
interface RecieverInterface extends RelationAttributInterface, MetaInterface, MembersAttributInterface
{
    public function getAllRecievers(): ArrayCollection;
}
