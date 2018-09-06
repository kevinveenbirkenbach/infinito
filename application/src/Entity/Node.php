<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Attribut\ParentAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="App\Repository\NodeRepository")
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

