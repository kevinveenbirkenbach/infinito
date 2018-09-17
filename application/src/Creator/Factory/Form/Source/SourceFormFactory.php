<?php
namespace App\Creator\Factory\Form\Source;

use App\Entity\SourceInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
class SourceFormFactory
{
    const FORM_NAMESPACE = 'App\Form\\';
    
    /**
     * @var SourceInterface
     */
    private $source;
    
    public function __construct(SourceInterface $source){
        $this->source = $source;
    }
    
    public function getNamespace():string{
        return self::FORM_NAMESPACE.$this->getName();
    }
    
    protected function getName(): string
    {
        $reflectionClass = new \ReflectionClass($this->source);
        return $reflectionClass->getShortName().'Type';
    }
}

