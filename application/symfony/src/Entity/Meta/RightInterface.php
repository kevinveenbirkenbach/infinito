<?php

namespace App\Entity\Meta;

use App\Attribut\CrudAttributInterface;
use App\Attribut\LawAttributInterface;
use App\Attribut\RecieverAttributInterface;
use App\Attribut\GrantAttributInterface;
use App\Attribut\ConditionAttributInterface;
use App\Attribut\LayerAttributInterface;
use App\Attribut\RelationAttributInterface;
use App\Attribut\PriorityAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends CrudAttributInterface, LawAttributInterface, GrantAttributInterface, RecieverAttributInterface, RelationAttributInterface, ConditionAttributInterface, LayerAttributInterface, MetaInterface, PriorityAttributInterface
{
}
