<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\SourceManagement\SourceMemberManagerInterface;
use Infinito\Domain\SourceManagement\SourceMemberManager;
use Infinito\Entity\Source\PureSource;

class SourceMemberManagerTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var SourceMemberManagerInterface
     */
    private $sourceMemberManager;

    public function setUp(): void
    {
        $this->source = new PureSource();
        $this->sourceMemberManager = new SourceMemberManager($this->source);
    }

    public function testAddAndRemoveMember(): void
    {
        $member = new PureSource();
        $this->assertNull($this->sourceMemberManager->addMember($member));
        $this->assertEquals($member, $this->source->getMemberRelation()->getMembers()->get(0)->getSource());
        $this->assertEquals($this->source, $member->getMemberRelation()->getMemberships()->get(0)->getSource());
        $this->assertNull($this->sourceMemberManager->removeMember($member));
        $this->assertEquals(0, $this->source->getMemberRelation()->getMembers()->count());
        $this->assertEquals(0, $member->getMemberRelation()->getMemberships()->count());
    }

    public function testAddAndRemoveMembership(): void
    {
        $membership = new PureSource();
        $this->assertNull($this->sourceMemberManager->addMembership($membership));
        $this->assertEquals($membership, $this->source->getMemberRelation()->getMemberships()->get(0)->getSource());
        $this->assertEquals($this->source, $membership->getMemberRelation()->getMembers()->get(0)->getSource());
        $this->assertNull($this->sourceMemberManager->removeMembership($membership));
        $this->assertEquals(0, $this->source->getMemberRelation()->getMemberships()->count());
        $this->assertEquals(0, $membership->getMemberRelation()->getMembers()->count());
    }
}
