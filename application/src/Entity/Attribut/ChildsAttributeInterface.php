<?php
namespace App\Entity\Attribut;
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 * @author kevinfrantz
 *        
 */
interface ChildsAttributeInterface
{
    public function setChilds(ArrayCollection $childs):void;
    
    public function getChilds():ArrayCollection;
}

