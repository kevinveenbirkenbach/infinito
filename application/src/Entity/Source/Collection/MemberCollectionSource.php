<?php

namespace App\Entity\Source\Collection;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Attribut\MembersAttribut;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @author kevinfrantz
 * @ORM\Table(name="source_group")
 * @ORM\Entity
 */
final class MemberCollectionSource extends AbstractCollectionSource implements MemberCollectionSourceInterface
{
    use MembersAttribut;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AbstractSource",inversedBy="groups")
     * @ORM\JoinTable(name="source_group_members")
     */
    protected $members;

    public function __construct()
    {
        parent::__construct();
        $this->members = new ArrayCollection();
    }
}
