<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\TypeAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface RightInterface extends TypeAttributInterface
{
    
    public function isGranted(NodeInterface $node): bool;
    
    public function setPermissions(ArrayCollection $permissions):void;
}