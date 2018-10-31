<?php

namespace App\Entity\Source;

use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Entity\Source\Attribut\GroupSourcesAttributInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, GroupSourcesAttributInterface, LawAttributInterface, RelationAttributInterface
{
}
