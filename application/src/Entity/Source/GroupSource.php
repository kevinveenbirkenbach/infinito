<?php
namespace App\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Attribut\MembersAttributInterface;
use App\Entity\Source\Attribut\MembersAttribut;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="source_group")
 * @ORM\Entity
 */
final class GroupSource extends AbstractSource implements MembersAttributInterface
{
    use MembersAttribut;

    /**
     *
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AbstractSource")
     */
    protected $members;
    
    public function __construct() {
        parent::__construct();
        $this->members = new ArrayCollection();
    }
}

