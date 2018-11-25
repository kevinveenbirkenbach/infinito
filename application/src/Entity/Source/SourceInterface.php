<?php

namespace App\Entity\Source;

use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembershipsAttributInterface;
use App\Entity\Attribut\SlugAttributInterface;
use App\Entity\Attribut\MembersAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, MembershipsAttributInterface, LawAttributInterface, RelationAttributInterface, SlugAttributInterface, MembersAttributInterface
{
}
