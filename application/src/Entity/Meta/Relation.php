<?php

namespace App\Entity\Meta;

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
 * This class represents a relation. 
 * It allows a better right management of the meta informations.
 * Also it is used to capsel the logic relation to an own logical unit. 
 * @author kevinfrantz
 * @todo rename and refactor this class
 * @ORM\Table(name="meta_relation")
 * @ORM\Entity()
 */
class Relation extends AbstractMeta implements RelationInterface
{
    use IdAttribut,
    SourceAttribut,
    ParentsAttribut,
    LawAttribut,
    ChildsAttribut;
    
    /**
     * Parents represent the creators of the relation
     * @ORM\ManyToMany(targetEntity="Relation")
     * @ORM\JoinTable(name="meta_relation_parents",
     *      joinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|RelationInterface[]
     */
    protected $parents;
    
    /**
     * Childs represent the by the object produced relations
     * @todo Replace this by self referencing 
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html
     * @ORM\ManyToMany(targetEntity="Relation")
     * @ORM\JoinTable(name="meta_relation_childs",
     *      joinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|RelationInterface[]
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
