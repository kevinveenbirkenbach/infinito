<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\ParentRelationInterface;

interface ParentRelationAttributInterface
{
    public function setParentRelation(ParentRelationInterface $parentRelation): void;

    public function getParentRelation(): ParentRelationInterface;
}
