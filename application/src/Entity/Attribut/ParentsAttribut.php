<?php

namespace App\Entity\Attribut;

use App\Entity\Interfaces\NodeInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait ParentsAttribut
{
    /**
     * Many Nodes have many parents.
     *
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_parents",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|NodeInterface[]
     */
    protected $parents;

    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function setParents(Collection $parents): void
    {
        $this->parents = $parents;
    }
}
