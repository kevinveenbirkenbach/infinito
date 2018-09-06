<?php
namespace App\Entity\attribut;

use App\Entity\SourceInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface SourceAttributInterface
{
    public function getSource():SourceInterface;
    
    public function setSource(SourceInterface $source):void;
}

