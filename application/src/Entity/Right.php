<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\TypeAttribut;
use App\DBAL\Types\RightType;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="right")
 * @ORM\Entity(repositoryClass="App\Repository\RightRepository")
 */
class Right extends AbstractEntity implements RightInterface
{
    use TypeAttribut;
    
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

