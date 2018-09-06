<?php
namespace App\Entity\attribut;

use App\Entity\NodeInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface NodeAttributInterface
{
    public function setNode(NodeInterface $node):void;
    
    public function getNode():NodeInterface;
}

