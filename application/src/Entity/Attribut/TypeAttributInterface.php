<?php
namespace App\Entity\Attribut;

/**
 *
 * @author kevinfrantz
 *        
 */
interface TypeAttributInterface
{
    public function setType(string $right):void;
    
    public function getType():string;
}

