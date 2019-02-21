<?php

namespace Infinito\Entity\Meta;

use Infinito\Attribut\LawAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\GrantAttributInterface;
use Infinito\Attribut\ConditionAttributInterface;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Attribut\RelationAttributInterface;
use Infinito\Attribut\PriorityAttributInterface;
use Infinito\Attribut\ActionTypeAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends ActionTypeAttributInterface, LawAttributInterface, GrantAttributInterface, RecieverAttributInterface, RelationAttributInterface, ConditionAttributInterface, LayerAttributInterface, MetaInterface, PriorityAttributInterface
{
}
