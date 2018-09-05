<?php
namespace App\Entity;

/**
 *
 * @author kevinfrantz
 *        
 */
class AbstractSource implements SourceInterface
{  
    /**
     * 
     * @var Node
     */
    protected $node;
    
    /**
     * 
     * @var ConfigurationInterface
     */
    protected $configuration;
    
    /**
     *
     * @var int
     */
    protected $id;
    
    public function setId(int $id): void
    {}
    
    public function setNode(NodeInterface $node): void
    {}
    
    public function getId(): int
    {}
    
    public function getNode(): NodeInterface
    {}
    
}