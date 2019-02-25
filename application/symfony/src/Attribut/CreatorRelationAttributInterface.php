<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;

/**
 * @author kevinfrantz
 */
interface CreatorRelationAttributInterface
{
    const CREATORRELATION_ATTRIBUT_NAME = 'creatorRelation';

    /**
     * @param CreatorRelationInterface $creatorRelation
     */
    public function setCreatorRelation(CreatorRelationInterface $creatorRelation);

    /**
     * @return CreatorRelationInterface
     */
    public function getCreatorRelation(): CreatorRelationInterface;
}
