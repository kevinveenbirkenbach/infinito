<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\CrudAttributInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\GrantAttributInterface;
use App\Entity\Attribut\ConditionAttributInterface;
use App\Entity\Attribut\LayerAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\PriorityAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends CrudAttributInterface, LawAttributInterface, GrantAttributInterface, RecieverAttributInterface, RelationAttributInterface, ConditionAttributInterface, LayerAttributInterface, MetaInterface, PriorityAttributInterface
{
}
