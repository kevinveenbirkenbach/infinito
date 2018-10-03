<?php

namespace App\Entity;

use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Method\NodeGrantedInterface;
use App\Entity\Attribut\RecieverGroupAttributInterface;
use App\Entity\Attribut\GrantAttributInterface;
use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\ConditionAttributInterface;
use App\Entity\Attribut\LayerAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends TypeAttributInterface, LawAttributInterface, NodeGrantedInterface, GrantAttributInterface, RecieverGroupAttributInterface, NodeAttributInterface, ConditionAttributInterface, LayerAttributInterface
{
}
