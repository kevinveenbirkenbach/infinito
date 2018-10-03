<?php

namespace App\Entity;

use App\Entity\Attribut\Interfaces\SourceAttributInterface;
use App\Entity\Attribut\Interfaces\IdAttributInterface;
use App\Entity\Attribut\Interfaces\ParentsAttributInterface;
use App\Entity\Attribut\Interfaces\ChildsAttributeInterface;
use App\Entity\Attribut\Interfaces\LawAttributInterface;

/**
 * @author kevinfrantz
 */
interface NodeInterface extends SourceAttributInterface, IdAttributInterface, ParentsAttributInterface, ChildsAttributeInterface, LawAttributInterface
{
}
