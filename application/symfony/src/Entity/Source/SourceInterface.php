<?php

namespace Infinito\Entity\Source;

use Infinito\Attribut\IdAttributInterface;
use Infinito\Entity\EntityInterface;
use Infinito\Attribut\LawAttributInterface;
use Infinito\Attribut\CreatorRelationAttributInterface;
use Infinito\Attribut\MemberRelationAttributInterface;
use Infinito\Attribut\SlugAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, LawAttributInterface, CreatorRelationAttributInterface, MemberRelationAttributInterface, SlugAttributInterface
{
}
