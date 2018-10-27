<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\GroupSourceInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface GroupSourcesAttributInterface
{
    /**
     * @param Collection|GroupSourceInterface[] $groups
     */
    public function setGroupSources(Collection $groups):void;
    
    /**
     * @return Collection|GroupSourceInterface[]
     */
    public function getGroupSources():Collection;
}

