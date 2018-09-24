<?php

namespace App\Entity\Interfaces;

use App\Entity\Attribut\Interfaces\TypeAttributInterface;
use App\Entity\Attribut\Interfaces\LawAttributInterface;
use App\Entity\Method\Interfaces\NodeGrantedInterface;
use App\Entity\Attribut\Interfaces\RecieverGroupAttributInterface;
use App\Entity\Attribut\Interfaces\GrantAttributInterface;
use App\Entity\Attribut\Interfaces\NodeAttributInterface;
use App\Entity\Attribut\Interfaces\ConditionAttributInterface;
use App\Entity\Attribut\Interfaces\LayerAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends TypeAttributInterface, LawAttributInterface, NodeGrantedInterface, GrantAttributInterface, RecieverGroupAttributInterface, NodeAttributInterface, ConditionAttributInterface, LayerAttributInterface
{
}
