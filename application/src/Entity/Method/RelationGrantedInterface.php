<?php

namespace App\Entity\Method;

use App\Entity\RelationInterface;

/**
 * @author kevinfrantz
 */
interface RelationGrantedInterface
{
    public function isGranted(RelationInterface $relation, string $layer, string $right): bool;
}
