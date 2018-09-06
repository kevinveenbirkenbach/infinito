<?php
namespace App\Entity\attribut;

use App\Entity\SourceInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
trait SourceAttribut {
    /**
     * @var SourceInterface
     */
    protected $source;
    
    public function getSource():SourceInterface{
        return $this->source;
    }
    
    public function setSource(SourceInterface $source):void{
        $this->source = $source;
    }
}

