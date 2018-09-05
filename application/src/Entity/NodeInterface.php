<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
interface NodeInterface
{
    public function getId():int;
    
    public function setParents(ArrayCollection $parents):void;
    
    public function getParents():ArrayCollection;
    
    public function setChilds(ArrayCollection $childs):void;
    
    public function getChilds():ArrayCollection;
    
    public function getSource():SourceInterface;
    
    public function setSource(SourceInterface $source):void;
}

