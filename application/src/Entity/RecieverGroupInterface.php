<?php

namespace App\Entity;

use App\Entity\Attribut\RecieverAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface RecieverGroupInterface extends RelationAttributInterface, RecieverAttributInterface
{
    public function getAllRecievers(): ArrayCollection;
}
