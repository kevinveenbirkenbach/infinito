<?php

namespace Infinito\Entity\Meta\Relation\Parent;

use Infinito\Attribut\ParentsAttributInterface;
use Infinito\Attribut\ChildsAttributInterface;
use Infinito\Entity\Meta\Relation\RelationInterface;

interface ParentRelationInterface extends RelationInterface, ParentsAttributInterface, ChildsAttributInterface
{
}
