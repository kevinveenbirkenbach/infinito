<?php

namespace App\Entity;

use App\Entity\Attribut\NodeAttribut;
use App\Entity\Attribut\RecieverAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use App\DBAL\Types\RecieverType;
use Symfony\Component\Intl\Exception\NotImplementedException;

/**
 * @author kevinfrantz
 */
class RecieverGroup extends AbstractEntity implements RecieverGroupInterface
{
    use NodeAttribut,RecieverAttribut;

    /**
     * @ORM\Column(name="reciever", type="RecieverType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\RecieverType")
     *
     * @var string
     */
    protected $reciever;

    /**
     * The node for which the right exists.
     *
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     *
     * @var NodeInterface
     */
    protected $node;

    public function getAllRecievers(): ArrayCollection
    {
        switch ($this->reciever) {
            case RecieverType::PARENTS:
                return $this->node->getParents();
            case RecieverType::NODE:
                return new ArrayCollection([$this->node]);
            case RecieverType::CHILDREN:
                return $this->node->getChilds();
        }
        throw new NotImplementedException('Reciever '.$this->reciever.' not implemented.');
    }
}
