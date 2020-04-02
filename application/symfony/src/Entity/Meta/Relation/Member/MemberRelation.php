<?php

namespace Infinito\Entity\Meta\Relation\Member;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\MembersAttribut;
use Infinito\Attribut\MembershipsAttribut;
use Infinito\Entity\Meta\Relation\AbstractRelation;

/**
 * @author kevinfrantz
 * @ORM\Entity(repositoryClass="Infinito\Repository\Meta\Relation\Member\MemberRepository")
 */
class MemberRelation extends AbstractRelation implements MemberRelationInterface
{
    use MembersAttribut;
    use MembershipsAttribut;

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
