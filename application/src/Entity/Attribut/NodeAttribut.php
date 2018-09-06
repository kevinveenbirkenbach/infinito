<?php
namespace App\Entity\Attribut;

use App\Entity\NodeInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
trait NodeAttribut{
    /**
     * @var NodeInterface
     * @OneToOne(targetEntity="Node")
     * @JoinColumn(name="source", referencedColumnName="id")
     */
    protected $node;
    
    public function setNode(NodeInterface $node): void
    {
        $this->node = $node;
    }
    
    public function getNode(): NodeInterface
    {
        return $this->node;
    }
    
}

