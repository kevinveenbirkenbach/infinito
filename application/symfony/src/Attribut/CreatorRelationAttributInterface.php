<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;

interface CreatorRelationAttributInterface
{
    public function setCreatorRelation(CreatorRelationInterface $creatorRelation);

    public function getCreatorRelation(): CreatorRelationInterface;
}
