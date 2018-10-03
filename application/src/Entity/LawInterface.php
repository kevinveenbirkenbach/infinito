<?php

namespace App\Entity;

use App\Entity\Attribut\RightsAttributInterface;
use App\Entity\Method\NodeGrantedInterface;
use App\Entity\Attribut\NodeAttributInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, NodeGrantedInterface, NodeAttributInterface
{
}
