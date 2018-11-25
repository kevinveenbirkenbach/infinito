<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberManagerInterface;
use App\Entity\Source\AbstractSource;
use App\Domain\SourceManagement\SourceMemberManager;

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

    private function createSource(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    public function setUp(): void
    {
        $this->source = $this->createSource();
        $this->sourceMemberManager = new SourceMemberManager($this->source);
    }

    public function testAddAndRemoveMember(): void
    {
        $member = $this->createSource();
        $this->assertNull($this->sourceMemberManager->addMember($member));
        $this->assertEquals($member, $this->source->getMembers()->get(0));
        $this->assertEquals($this->source, $member->getMemberships()->get(0));
        $this->assertNull($this->sourceMemberManager->removeMember($member));
        $this->assertEquals(0, $this->source->getMembers()->count());
        $this->assertEquals(0, $member->getMemberships()->count());
    }

    public function testAddAndRemoveMembership(): void
    {
        $membership = $this->createSource();
        $this->assertNull($this->sourceMemberManager->addMembership($membership));
        $this->assertEquals($membership, $this->source->getMemberships()->get(0));
        $this->assertEquals($this->source, $membership->getMembers()->get(0));
        $this->assertNull($this->sourceMemberManager->removeMembership($membership));
        $this->assertEquals(0, $this->source->getMemberships()->count());
        $this->assertEquals(0, $membership->getMembers()->count());
    }
}
