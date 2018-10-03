<?php

namespace App\Entity;

use App\Entity\Attribut\Interfaces\RightsAttributInterface;
use App\Entity\Method\Interfaces\NodeGrantedInterface;
use App\Entity\Attribut\Interfaces\NodeAttributInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, NodeGrantedInterface, NodeAttributInterface
{
}
