<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\RelationInterface;

/**
 * @author kevinfrantz
 *
 * @see RelationAttributInterface
 */
trait RelationAttribut
{
    /**
     * @var RelationInterface
     */
    protected $relation;

    /**
     * @param RelationInterface $relation
     *
     * @see RelationAttributInterface
     */
    public function setRelation(RelationInterface $relation): void
    {
        $this->relation = $relation;
    }

    /**
     * @see RelationAttributInterface
     *
     * @return RelationInterface
     */
    public function getRelation(): RelationInterface
    {
        return $this->relation;
    }
}
