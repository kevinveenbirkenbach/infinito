<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\SourceAttributInterface;
use App\Entity\Attribut\IdAttributInterface;
use App\Entity\Attribut\ParentsAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface NodeInterface extends SourceAttributInterface, IdAttributInterface,ParentsAttributInterface
{   
    public function setChilds(ArrayCollection $childs):void;
    
    public function getChilds():ArrayCollection;
}

