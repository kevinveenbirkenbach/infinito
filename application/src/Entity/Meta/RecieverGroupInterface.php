<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RecieverAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupInterface extends RelationAttributInterface, RecieverAttributInterface, MetaInterface
{
    public function getAllRecievers(): ArrayCollection;
}
