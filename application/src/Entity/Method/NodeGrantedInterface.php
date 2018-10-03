<?php

namespace App\Entity\Method\Interfaces;

use App\Entity\Interfaces\NodeInterface;

/**
 * @author kevinfrantz
 */
interface NodeGrantedInterface
{
    public function isGranted(NodeInterface $node, string $layer, string $right): bool;
}
