<?php

namespace App\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembersAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_reciever_group")
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

    public function getAllRecievers(): ArrayCollection
    {
        foreach ($this->members->getValues() as $source) {
        }
    }
}
