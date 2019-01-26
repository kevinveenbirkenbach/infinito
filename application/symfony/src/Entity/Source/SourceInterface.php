<?php

namespace App\Entity\Source;

use App\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Attribut\LawAttributInterface;
use App\Attribut\CreatorRelationAttributInterface;
use App\Attribut\MemberRelationAttributInterface;
use App\Attribut\SlugAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, LawAttributInterface, CreatorRelationAttributInterface, MemberRelationAttributInterface, SlugAttributInterface
{
}
