<?php

namespace App\Entity;

use App\Entity\Attribut\BlacklistAttributInterface;
use App\Entity\Attribut\WhitelistAttributInterface;
use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\RightAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;

/**
 * @author kevinfrantz
 */
interface PermissionInterface extends BlacklistAttributInterface, WhitelistAttributInterface, NodeAttributInterface, RightAttributInterface, RecieverAttributInterface
{
}
