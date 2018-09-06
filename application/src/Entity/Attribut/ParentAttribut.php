<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\NodeInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
trait ParentAttribut {

    /**
     * Many Nodes have many parents
     *
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_parents",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     * @var ArrayCollection|NodeInterface[]
     */
    protected $parents;

    public function getParents(): ArrayCollection
    {
        return $this->parents;
    }

    public function setParents(ArrayCollection $parents): void
    {
        $this->parents = $parents;
    }
}

