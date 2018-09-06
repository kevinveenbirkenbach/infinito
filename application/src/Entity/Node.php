<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\attribut\IdAttribut;
use App\Entity\attribut\SourceAttribut;
use Entity\attribut\ParentAttribut;

/**
 *
 * @author kevinfrantz
 *        
 */
class Node implements NodeInterface
{
    use IdAttribut,SourceAttribut, ParentAttribut;
    
    /**
     * 
     * @var ArrayCollection|Node[]
     */
    protected $childs;

    public function getChilds(): ArrayCollection
    {}

    public function setChilds(ArrayCollection $childs): void
    {}
}

