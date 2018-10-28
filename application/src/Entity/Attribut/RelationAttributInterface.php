<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\RelationInterface;

/**
 * @author kevinfrantz
 */
interface RelationAttributInterface
{
    public function setRelation(RelationInterface $relation): void;

    public function getRelation(): RelationInterface;
}
