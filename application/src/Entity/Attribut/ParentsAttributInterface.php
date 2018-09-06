<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
interface ParentsAttributInterface
{
    public function setParents(ArrayCollection $parents):void;
    
    public function getParents():ArrayCollection;
}

