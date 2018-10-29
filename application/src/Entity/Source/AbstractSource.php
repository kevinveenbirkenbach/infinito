<?php

namespace App\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use App\Entity\AbstractEntity;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Attribut\GroupSourcesAttribut;
use App\Entity\Meta\RelationInterface;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Meta\Relation;
use App\Entity\Attribut\LawAttribut;
use App\Entity\Meta\LawInterface;
use App\Entity\Meta\Law;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html
 * @ORM\Entity
 * @ORM\Table(name="source")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "UserSource","name" = "NameSource","group" = "GroupSource"})
 */
abstract class AbstractSource extends AbstractEntity implements SourceInterface
{
    use RelationAttribut,GroupSourcesAttribut, LawAttribut;

    /**
     * @var RelationInterface
     * @ORM\OneToOne(targetEntity="App\Entity\Meta\Relation",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="relation_id", referencedColumnName="id")
     * @Exclude
     */
    protected $relation;

    /**
     * @todo Implement that just one table on database level is needed!
     * @todo Rename table to use the right schema
     *
     * @var Collection|GroupSource[]
     * @ORM\ManyToMany(targetEntity="GroupSource")
     */
    protected $groups;

    /**
     * @ORM\OneToOne(targetEntity="Law",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    public function __construct()
    {
        parent::__construct();
        $this->relation = new Relation();
        $this->relation->setSource($this);
        $this->law = new Law();
        $this->groups = new ArrayCollection();
    }
}
