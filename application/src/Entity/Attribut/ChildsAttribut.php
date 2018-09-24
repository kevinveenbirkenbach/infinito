<?php

namespace App\Entity\Attribut;

use App\Entity\Interfaces\NodeInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait ChildsAttribut
{
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

    public function getChilds(): Collection
    {
        return $this->childs;
    }

    public function setChilds(Collection $childs): void
    {
        $this->childs = $childs;
    }
}
