<?php

namespace App\Entity\Method;

use App\Entity\Meta\RelationInterface;

/**
 * @author kevinfrantz
 */
interface RelationGrantedInterface
{
    /**
     * @deprecated Methods shouldn't be used on the entity level
     * @param RelationInterface $relation
     * @param string $layer
     * @param string $right
     * @return bool
     */
    public function isGranted(RelationInterface $relation, string $layer, string $right): bool;
}
