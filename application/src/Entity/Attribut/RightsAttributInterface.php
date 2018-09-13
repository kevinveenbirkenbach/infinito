<?php
namespace Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
interface RightsAttributInterface
{
    public function setRights(ArrayCollection $rights):void;
    
    public function getRights():ArrayCollection;
}

