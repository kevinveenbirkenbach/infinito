<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\NodeInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
trait ParentAttribut {
    /**
     *
     * @var ArrayCollection|NodeInterface[]
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

