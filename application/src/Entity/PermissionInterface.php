<?php

namespace App\Entity;

use App\Entity\Attribut\BlacklistAttributInterface;
use Entity\Attribut\WhitelistAttributInterface;
use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\RightAttributInterface;

/**
 * @author kevinfrantz
 */
interface PermissionInterface extends BlacklistAttributInterface, WhitelistAttributInterface, NodeAttributInterface, RightAttributInterface
{
}
