<?php
namespace App\Entity;

/**
 *
 * @author kevinfrantz
 *        
 */
class Configuration extends AbstractSource implements ConfigurationInterface
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
}

