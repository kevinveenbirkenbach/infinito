<?php

namespace App\Entity\Meta\Relation\Member;

use App\Entity\Meta\Relation\AbstractRelation;
use App\Attribut\MembersAttribut;
use App\Attribut\MembershipsAttribut;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 */
class MemberRelation extends AbstractRelation implements MemberRelationInterface
{
    use MembersAttribut,MembershipsAttribut;

    /**
     * Many Sources have many Source Members.
     *
     * @var Collection|MemberRelationInterface[]
     * @ORM\ManyToMany(targetEntity="MemberRelation", inversedBy="memberships",cascade={"persist", "remove"})
     * @ORM\JoinTable(name="source_members",
     *      joinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id",onDelete="CASCADE")}
     *      )
     */
    protected $members;

    /**
     * @var Collection|MemberRelationInterface[]
     * @ORM\ManyToMany(targetEntity="MemberRelation",mappedBy="members")
     */
    protected $memberships;

    public function __construct()
    {
        parent::__construct();
        $this->members = new ArrayCollection();
        $this->memberships = new ArrayCollection();
    }
}
