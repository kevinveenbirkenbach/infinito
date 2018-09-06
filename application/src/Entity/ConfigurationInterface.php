<?php
namespace App\Entity;

/**
 * This class is not a source!
 * @author kevinfrantz
 *        
 */
interface ConfigurationInterface
{
    public function setRead(Property $read):void;
    
    public function getRead():Property;
    
    public function setWrite(Property $write):void;
    
    public function getWrite():Property;
    
    public function setAdministrate(Property $administrate):void;
    
    public function getAdministrate():Property;
    
}

