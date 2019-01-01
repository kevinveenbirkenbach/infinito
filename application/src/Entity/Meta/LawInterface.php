<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RightsAttributInterface;
use App\Entity\Attribut\GrantAttributInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, MetaInterface, GrantAttributInterface
{
}
