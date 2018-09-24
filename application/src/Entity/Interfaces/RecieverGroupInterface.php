<?php

namespace App\Entity\Interfaces;

use App\Entity\Attribut\Interfaces\NodeAttributInterface;
use App\Entity\Attribut\Interfaces\RecieverAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
interface RecieverGroupInterface extends NodeAttributInterface, RecieverAttributInterface
{
    public function getAllRecievers(): ArrayCollection;
}
