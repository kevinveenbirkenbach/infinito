<?php
namespace App\Entity;

/**
 *
 * @author kevinfrantz
 *        
 */
interface SourceInterface
{
    public function setId(int $id):void;
    
    public function getId():int;
    
    public function setNode(NodeInterface $node):void;
    
    public function getNode():NodeInterface;
}

