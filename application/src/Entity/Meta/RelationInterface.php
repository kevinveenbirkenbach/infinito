<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\SourceAttributInterface;
use App\Entity\Attribut\IdAttributInterface;
use App\Entity\Attribut\ParentsAttributInterface;
use App\Entity\Attribut\ChildsAttributeInterface;
use App\Entity\Attribut\LawAttributInterface;

/**
 * @author kevinfrantz
 */
interface RelationInterface extends SourceAttributInterface, IdAttributInterface, ParentsAttributInterface, ChildsAttributeInterface, LawAttributInterface, MetaInterface
{
}
