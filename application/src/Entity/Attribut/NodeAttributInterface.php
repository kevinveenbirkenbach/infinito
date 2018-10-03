<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\NodeInterface;

/**
 * @author kevinfrantz
 */
interface NodeAttributInterface
{
    public function setNode(NodeInterface $node): void;

    public function getNode(): NodeInterface;
}
