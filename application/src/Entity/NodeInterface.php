<?php

namespace App\Entity;

use App\Entity\Attribut\SourceAttributInterface;
use App\Entity\Attribut\IdAttributInterface;
use App\Entity\Attribut\ParentsAttributInterface;
use App\Entity\Attribut\ChildsAttributeInterface;

/**
 * @author kevinfrantz
 */
interface NodeInterface extends SourceAttributInterface, IdAttributInterface, ParentsAttributInterface, ChildsAttributeInterface
{
}
