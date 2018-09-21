<?php

namespace App\Entity;

use App\Entity\Attribut\RightsAttributInterface;
use App\Entity\Method\NodeGrantedInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, NodeGrantedInterface
{
}
