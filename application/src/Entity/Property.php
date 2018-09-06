<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
class Property implements PropertyInterface
{
    /**
     * 
     * @var ArrayCollection|NodeInterface[]
     */
    protected $whitelist;
    
    /**
     * 
     * @var ArrayCollection|NodeInterface[]
     */
    protected $blacklist;
    
    public function getLegitimated(): ArrayCollection
    {}

    public function isLegitimated(SourceInterface $source): bool
    {}

}

