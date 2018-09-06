<?php
namespace App\Entity\Attribut;

use App\Entity\SourceInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
trait SourceAttribut {
    /**
     * @ORM\OneToOne(targetEntity="AbstractSource")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
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

