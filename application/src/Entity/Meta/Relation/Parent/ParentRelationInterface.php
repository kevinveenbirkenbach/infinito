<?php

namespace App\Entity\Meta\Relation\Parent;

use App\Entity\Attribut\ParentsAttributInterface;
use App\Entity\Attribut\ChildsAttributeInterface;
use App\Entity\Meta\Relation\RelationInterface;

interface ParentRelationInterface extends RelationInterface, ParentsAttributInterface, ChildsAttributeInterface
{
}
