<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\SourceInterface;
use App\Entity\Attribut\RightAttribut;
use App\Entity\Attribut\CollectionAttribut;
use App\Entity\Method\CollectionDimensionHelperMethod;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_reciever")
 * @ORM\Entity()
 */
class Reciever extends AbstractMeta implements RecieverInterface
{
    use RightAttribut, CollectionAttribut,CollectionDimensionHelperMethod;

    /**
     * The right which the reciever group belongs to.
     *
     * @ORM\OneToOne(targetEntity="Right",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="right_id", referencedColumnName="id")
     *
     * @var RightInterface
     */
    protected $right;

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
