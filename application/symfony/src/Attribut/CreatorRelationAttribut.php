<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;

trait CreatorRelationAttribut
{
    /**
     * @var CreatorRelationInterface
     */
    protected $creatorRelation;

    public function setCreatorRelation(CreatorRelationInterface $creatorRelation)
    {
        $this->creatorRelation = $creatorRelation;
    }

    public function getCreatorRelation(): CreatorRelationInterface
    {
        return $this->creatorRelation;
    }
}
