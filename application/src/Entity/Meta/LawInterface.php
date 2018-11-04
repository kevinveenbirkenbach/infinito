<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RightsAttributInterface;
use App\Entity\Method\GrantedInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, GrantedInterface, MetaInterface
{
}
