<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
trait ParentAttribut {
    
    /**
     * @var ArrayCollection
     */
    protected $parents;
    
    public function getParents(): ArrayCollection
    {
        return $this->parents;
    }
    
    public function setParents(ArrayCollection $parents): void
    {
        $this->parents = $parents;
    }
}

