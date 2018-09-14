<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\TypeAttribut;
use App\DBAL\Types\RightType;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\Entity\Attribut\LawAttribut;
use App\Entity\Attribut\PermissionsAttribut;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 * @ORM\Table(name="`right`")
 * @ORM\Entity(repositoryClass="App\Repository\RightRepository")
 */
class Right extends AbstractEntity implements RightInterface
{
    use TypeAttribut,LawAttribut,PermissionsAttribut;

    /**
     * @ORM\ManyToOne(targetEntity="Law", inversedBy="rights")
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    /**
     * @ORM\Column(name="type", type="RightType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\RightType")
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Permission", mappedBy="right", cascade={"persist", "remove"})
     *
     * @var Collection
     */
    protected $permissions;

    public function isGranted(NodeInterface $node): bool
    {
    }

    public function __construct()
    {
        parent::__construct();
        $this->permissions = new ArrayCollection();
    }
}
