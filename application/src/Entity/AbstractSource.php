<?php
namespace App\Entity;

use App\Entity\attribut\IdAttribut;
use App\Entity\attribut\NodeAttribut;

/**
 *
 * @author kevinfrantz
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html
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