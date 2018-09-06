<?php
namespace App\Entity;

use App\Entity\attribut\IdAttribut;
use App\Entity\attribut\NodeAttribut;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractSource implements SourceInterface
{  
    use IdAttribut,NodeAttribut;
    
    /**
     * 
     * @var ConfigurationInterface
     */
    protected $configuration;
    
}