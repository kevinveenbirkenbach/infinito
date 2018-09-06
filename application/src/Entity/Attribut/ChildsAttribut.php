<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 * @author kevinfrantz
 *        
 */
trait ChildsAttribut {
    
/**
     * @var ArrayCollection
     */
    protected $childs;
    
    public function getChilds(): ArrayCollection
    {
        return $this->getChilds();
    }
    
    public function setChilds(ArrayCollection $childs): void
    {
        $this->childs = $childs;
    }
    
}

