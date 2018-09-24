<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RightsAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\NodeAttribut;
use App\Entity\Interfaces\LawInterface;
use App\Entity\Interfaces\NodeInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="law")
 * @ORM\Entity(repositoryClass="App\Repository\LawRepository")
 */
class Law extends AbstractEntity implements LawInterface
{
    use RightsAttribute, NodeAttribut;

    /**
     * @ORM\OneToMany(targetEntity="Right", mappedBy="law", cascade={"persist", "remove"})
     *
     * @var ArrayCollection | Right[]
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
    }

    public function isGranted(NodeInterface $node, string $layer, string $right): bool
    {
        /*
         *
         * @var RightInterface
         */
        foreach ($this->rights->toArray() as $right) {
            if ($right->isGranted($node, $layer, $right)) {
                return true;
            }
        }

        return false;
    }
}
