<?php
namespace App\Entity;

/**
 *
 * @author kevinfrantz
 *        
 */
class Configuration implements ConfigurationInterface
{
    /**
     * 
     * @var PropertyInterface
     */
    protected $read;
    
    /**
     * 
     * @var PropertyInterface
     */
    protected $write;
    
    /**
     * 
     * @var PropertyInterface
     */
    protected $administrate;
    
    public function setAdministrate(Property $administrate): void
    {}

    public function getAdministrate(): Property
    {}

    public function setWrite(Property $write): void
    {}

    public function getWrite(): Property
    {}

    public function setRead(Property $read): void
    {}

    public function getRead(): Property
    {}

}

