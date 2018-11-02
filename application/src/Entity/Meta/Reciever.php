<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembersAttribut;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_reciever")
 * @ORM\Entity()
 */
class Reciever extends AbstractMeta implements RecieverInterface
{
    use RelationAttribut, MembersAttribut;

    /**
     * The node for which the right exists.
     *
     * @ORM\ManyToOne(targetEntity="Relation")
     * @ORM\JoinColumn(name="relation_id", referencedColumnName="id")
     *
     * @var RelationAttributInterface
     */
    protected $relation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Source\AbstractSource")
     * @ORM\JoinTable(name="meta_reciever_members",
     *      joinColumns={@ORM\JoinColumn(name="reciever_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection | SourceInterface[]
     */
    protected $collection;

    public function __construct()
    {
        parent::__construct();
        $this->collection = new ArrayCollection();
    }
}
