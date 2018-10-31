<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Attribut\RelationAttributInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_reciever_group")
 * @ORM\Entity()
 */
class Reciever extends AbstractMeta implements RecieverInterface
{
    use RelationAttribut;

    /**
     * The node for which the right exists.
     *
     * @ORM\ManyToOne(targetEntity="Relation")
     * @ORM\JoinColumn(name="relation_id", referencedColumnName="id")
     *
     * @var RelationAttributInterface
     */
    protected $relation;

    public function getAllRecievers(): ArrayCollection
    {
    }

}
