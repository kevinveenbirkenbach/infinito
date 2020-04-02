<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;

/**
 * @author kevinfrantz
 *
 * @see CreatorRelationAttributInterface
 */
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
