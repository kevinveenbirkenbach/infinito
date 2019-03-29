<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\RelationInterface;

/**
 * @author kevinfrantz
 */
interface RelationAttributInterface
{
    /**
     * @param RelationInterface $relation
     */
    public function setRelation(RelationInterface $relation): void;

    /**
     * @return RelationInterface
     */
    public function getRelation(): RelationInterface;
}
