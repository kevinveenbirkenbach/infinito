<?php
namespace Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
trait RightsAttribute {
    
    /**
     * @var ArrayCollection
     */
    protected $rights;
    
    public function setRights(ArrayCollection $rights):void{
        $this->rights = $rights;
    }
    
    public function getRights():ArrayCollection{
        return $this->rights;
    }
}

