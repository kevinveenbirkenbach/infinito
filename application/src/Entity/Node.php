<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Attribut\ParentAttribut;
use App\Entity\Attribut\ChildsAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="App\Repository\NodeRepository")
 */
class Node implements NodeInterface
{
    use IdAttribut,SourceAttribut, ParentAttribut, ChildsAttribut;
    
    /**
     * Many Nodes have many parents
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_parents",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     * @var ArrayCollection|Node[]
     */
    protected $parents;
    
    /**
     * Many Nodes have many childs
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_childs",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     * @var ArrayCollection|Node[]
     */
    protected $childs;
}

