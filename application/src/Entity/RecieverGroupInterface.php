<?php

namespace App\Entity;

use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
interface RecieverGroupInterface extends NodeAttributInterface, RecieverAttributInterface
{
    public function getAllRecievers(): ArrayCollection;
}
