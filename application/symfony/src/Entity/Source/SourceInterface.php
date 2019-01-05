<?php

namespace App\Entity\Source;

use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\SlugAttributInterface;
use App\Entity\Attribut\CreatorRelationAttributInterface;
use App\Entity\Attribut\MemberRelationAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, LawAttributInterface, SlugAttributInterface, CreatorRelationAttributInterface, MemberRelationAttributInterface
{
}
