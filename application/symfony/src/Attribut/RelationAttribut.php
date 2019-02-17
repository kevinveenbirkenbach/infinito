<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\RelationInterface;

/**
 * @author kevinfrantz
 */
trait RelationAttribut
{
    /**
     * @var RelationInterface
     */
    protected $relation;

    public function setRelation(RelationInterface $relation): void
    {
        $this->relation = $relation;
    }

    public function getRelation(): RelationInterface
    {
        return $this->relation;
    }
}
