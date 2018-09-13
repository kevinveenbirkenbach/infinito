<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\TypeAttribut;
use App\DBAL\Types\RightType;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\LawAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="`right`")
 * @ORM\Entity(repositoryClass="App\Repository\RightRepository")
 */
class Right extends AbstractEntity implements RightInterface
{
    use TypeAttribut,LawAttribut;
    
    /**
     * @ORM\ManyToOne(targetEntity="Law",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     * @var LawInterface
     */
    protected $law;
    
    /**
     * @ORM\Column(name="type", type="RightType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\RightType")
     * @var string
     */
    protected $type;
       
    public function isGranted(NodeInterface $node): bool
    {}

    public function setPermissions(ArrayCollection $permissions): void
    {}

}

