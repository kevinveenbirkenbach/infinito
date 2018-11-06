<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\GrantAttributInterface;
use App\Entity\Attribut\ConditionAttributInterface;
use App\Entity\Attribut\LayerAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends TypeAttributInterface, LawAttributInterface, GrantAttributInterface, RecieverAttributInterface, RelationAttributInterface, ConditionAttributInterface, LayerAttributInterface, MetaInterface
{
}
