<?php

namespace App\Entity\Method;

use App\Entity\NodeInterface;

/**
 * @author kevinfrantz
 */
interface NodeGrantedInterface
{
    public function isGranted(NodeInterface $node, string $layer, string $right): bool;
}
