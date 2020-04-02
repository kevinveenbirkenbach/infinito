<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;

/**
 * @author kevinfrantz
 */
interface CreatorRelationAttributInterface
{
    const CREATORRELATION_ATTRIBUT_NAME = 'creatorRelation';

    public function setCreatorRelation(CreatorRelationInterface $creatorRelation);

    public function getCreatorRelation(): CreatorRelationInterface;
}
