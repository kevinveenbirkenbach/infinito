<?php

namespace Infinito\Entity\Meta;

use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Attribut\ConditionAttributInterface;
use Infinito\Attribut\GrantAttributInterface;
use Infinito\Attribut\LawAttributInterface;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Attribut\PriorityAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends ActionTypeAttributInterface, LawAttributInterface, GrantAttributInterface, RecieverAttributInterface, ConditionAttributInterface, LayerAttributInterface, MetaInterface, PriorityAttributInterface
{
}
