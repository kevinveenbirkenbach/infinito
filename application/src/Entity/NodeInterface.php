<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\attribut\SourceAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface NodeInterface extends SourceAttributInterface
{
    public function getId():int;
    
    public function setParents(ArrayCollection $parents):void;
    
    public function getParents():ArrayCollection;
    
    public function setChilds(ArrayCollection $childs):void;
    
    public function getChilds():ArrayCollection;
}

