<?php

namespace App\Entity\Meta\Relation\Parent;

use App\Attribut\ParentsAttributInterface;
use App\Attribut\ChildsAttributeInterface;
use App\Entity\Meta\Relation\RelationInterface;

interface ParentRelationInterface extends RelationInterface, ParentsAttributInterface, ChildsAttributeInterface
{
}
