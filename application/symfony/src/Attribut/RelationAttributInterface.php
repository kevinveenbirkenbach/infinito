<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\RelationInterface;

/**
 * @author kevinfrantz
 */
interface RelationAttributInterface
{
    public function setRelation(RelationInterface $relation): void;

    public function getRelation(): RelationInterface;
}
