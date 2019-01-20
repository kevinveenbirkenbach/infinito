<?php

namespace App\Entity\Meta;

use App\Attribut\RightsAttributInterface;
use App\Attribut\GrantAttributInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, MetaInterface, GrantAttributInterface
{
}
