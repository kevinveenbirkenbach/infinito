<?php

namespace App\Attribut;

use App\Entity\Meta\Relation\Parent\ParentRelationInterface;

trait ParentRelationAttribut
{
    /**
     * @var ParentRelationInterface
     */
    protected $parentRelation;

    public function setParentRelation(ParentRelationInterface $parentRelation): void
    {
        $this->parentRelation = $parentRelation;
    }

    public function getParentRelation(): ParentRelationInterface
    {
        return $this->parentRelation;
    }
}
