<?php

namespace App\Entity;

use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\RightAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\GrantAttributInterface;

/**
 * @author kevinfrantz
 */
interface PermissionInterface extends NodeAttributInterface, RightAttributInterface, RecieverAttributInterface, GrantAttributInterface
{
}
