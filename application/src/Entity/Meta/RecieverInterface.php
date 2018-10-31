<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface RecieverInterface extends RelationAttributInterface, MetaInterface
{
    public function getAllRecievers(): ArrayCollection;
}
