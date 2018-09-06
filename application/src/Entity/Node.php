<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
class Node implements NodeInterface
{
    /**
     * 
     * @var int
     */
    protected $id;
    
    /**
     * 
     * @var SourceInterface
     */
    protected $source;
    
    /**
     * 
     * @var ArrayCollection|Node[]
     */
    protected $parents;
    
    /**
     * 
     * @var ArrayCollection|Node[]
     */
    protected $childs;
    
    public function getParents(): ArrayCollection
    {}

    public function setParents(ArrayCollection $parents): void
    {}

    public function getChilds(): ArrayCollection
    {}

    public function setChilds(ArrayCollection $childs): void
    {}
    
    public function getId(): int
    {}

    public function setSource(SourceInterface $source):void
    {}

    public function getSource(): SourceInterface
    {}

}

