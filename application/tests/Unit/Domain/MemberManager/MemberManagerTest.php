<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\MemberManagement\MemberManagerInterface;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;
use App\Entity\Meta\Relation\Member\MemberRelation;
use App\Domain\MemberManagement\MemberManager;

class MemberManagerTest extends TestCase
{
    /**
     * @var MemberRelationInterface
     */
    private $memberRelation;

    /**
     * @var MemberManagerInterface
     */
    private $MemberManager;

    public function setUp(): void
    {
        $this->memberRelation = new MemberRelation();
        $this->MemberManager = new MemberManager($this->memberRelation);
    }

    public function testAddAndRemoveMember(): void
    {
        $member = new MemberRelation();
        $this->assertNull($this->MemberManager->addMember($member));
        $this->assertEquals($member, $this->memberRelation->getMembers()->get(0));
        $this->assertEquals($this->memberRelation, $member->getMemberships()->get(0));
        $this->assertNull($this->MemberManager->removeMember($member));
        $this->assertEquals(0, $this->memberRelation->getMembers()->count());
        $this->assertEquals(0, $member->getMemberships()->count());
    }

    public function testAddAndRemoveMembership(): void
    {
        $membership = new MemberRelation();
        $this->assertNull($this->MemberManager->addMembership($membership));
        $this->assertEquals($membership, $this->memberRelation->getMemberships()->get(0));
        $this->assertEquals($this->memberRelation, $membership->getMembers()->get(0));
        $this->assertNull($this->MemberManager->removeMembership($membership));
        $this->assertEquals(0, $this->memberRelation->getMemberships()->count());
        $this->assertEquals(0, $membership->getMembers()->count());
    }
}