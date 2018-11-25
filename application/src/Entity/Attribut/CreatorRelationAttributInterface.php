<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\Relation\Parent\CreatorRelationInterface;

interface CreatorRelationAttributInterface
{
    public function setCreatorRelation(CreatorRelationInterface $creatorRelation);

    public function getCreatorRelation(): CreatorRelationInterface;
}
