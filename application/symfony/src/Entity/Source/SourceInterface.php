<?php

namespace Infinito\Entity\Source;

use Infinito\Attribut\CreatorRelationAttributInterface;
use Infinito\Attribut\IdAttributInterface;
use Infinito\Attribut\LawAttributInterface;
use Infinito\Attribut\MemberRelationAttributInterface;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, LawAttributInterface, CreatorRelationAttributInterface, MemberRelationAttributInterface, SlugAttributInterface
{
}
