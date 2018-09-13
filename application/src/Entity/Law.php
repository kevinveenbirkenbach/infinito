<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RightsAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use App\DBAL\Types\RightType;
use App\Entity\Attribut\NodeAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="law")
 * @ORM\Entity(repositoryClass="App\Repository\LawRepository")
 */
class Law extends AbstractEntity implements LawInterface
{
    use RightsAttribute, NodeAttribut;

    /**
     * @ORM\OneToMany(targetEntity="Right", mappedBy="id", cascade={"persist", "remove"})
     *
     * @var ArrayCollection
     */
    protected $rights;

    /**
     * @ORM\OneToOne(targetEntity="Node",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     *
     * @var NodeInterface
     */
    protected $node;

    public function __construct()
    {
        $this->initAllRights();
    }

    private function initAllRights(): void
    {
        $this->rights = new ArrayCollection();
        foreach (RightType::getChoices() as $key => $value) {
            $right = new Right();
            $right->setType($value);
            $right->setLaw($this);
            $this->rights->set($key, $right);
        }
    }
}
