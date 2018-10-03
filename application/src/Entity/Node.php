<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Attribut\ParentsAttribut;
use App\Entity\Attribut\ChildsAttribut;
use App\Entity\Attribut\LawAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 * @ORM\Table(name="node")
 * @ORM\Entity()
 */
class Node extends AbstractEntity implements NodeInterface
{
    use IdAttribut,
    SourceAttribut,
    ParentsAttribut,
    LawAttribut,
    ChildsAttribut;
    
    /**
     * Many Nodes have many parents.
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_parents",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|NodeInterface[]
     */
    protected $parents;
    
    /**
     * Many Nodes have many childs.
     * 
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_childs",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|NodeInterface[]
     */
    protected $childs;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     *
     * @var SourceInterface
     */
    protected $source;

    /**
     * @ORM\OneToOne(targetEntity="Law",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    public function __construct()
    {
        $this->law = new Law();
        $this->parents = new ArrayCollection();
        $this->childs = new ArrayCollection();
        $this->law->setNode($this);
    }
}
