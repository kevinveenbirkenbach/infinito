<?php

namespace App\Tests\Unit\Entity\Attribut;

use App\Entity\Attribut\MembersAttribut;
use App\Entity\Attribut\MembersAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Tests\AbstractTestCase;
use App\Entity\Source\SourceInterface;

class MembersAttributTest extends AbstractTestCase
{
    /**
     * @var MembersAttributInterface
     */
    protected $membersAttribut;

    public function setUp(): void
    {
        $this->membersAttribut = $this->getMembersAttributClassMock();
    }

    private function getMembersAttributClassMock(): MembersAttributInterface
    {
        return new class() implements MembersAttributInterface {
            use MembersAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->membersAttribut->getMembers();
        $this->membersAttribut->getMembersIncludingChildren();
    }

    public function testMembersAccessors()
    {
        $source1 = $this->createMock(SourceInterface::class);
        $source2 = clone $source1;
        $source3 = clone $source1;
        $members = new ArrayCollection([
            $source1,
            $source2,
            $source3,
        ]);
        $this->assertNull($this->membersAttribut->setMembers($members));
        $this->assertEquals($members, $this->membersAttribut->getMembers());
        $this->assertTrue($this->membersAttribut->getMembers()->contains($source1));
    }

    public function testFirstLevelMembersInclusiveChildren(): void
    {
        $source1 = $this->getMembersAttributClassMock();
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source3->setMembers(new ArrayCollection([$source4]));
        $members = new ArrayCollection([$source1, $source2, $source3]);
        $this->assertNull($this->membersAttribut->setMembers($members));
        $this->assertEquals(3, $this->membersAttribut->getMembersIncludingChildren(1)->count());
    }

    public function test3DimensionsMembersInclusiveChildren(): void
    {
        $source1 = $this->getMembersAttributClassMock();
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source1->setMembers(new ArrayCollection([$source2]));
        $source2->setMembers(new ArrayCollection([$source3]));
        $source3->setMembers(new ArrayCollection([$source4]));
        $source4->setMembers(new ArrayCollection());
        $this->membersAttribut->setMembers(new ArrayCollection([$source1]));
        $this->assertEquals(1, $this->membersAttribut->getMembers()->count());
        $this->assertEquals(1, $source1->getMembers()->count());
        $this->assertEquals(1, $source2->getMembers()->count());
        $this->assertEquals(1, $source3->getMembers()->count());
        $this->assertEquals(0, $source4->getMembers()->count());
        $this->assertEquals(3, $this->membersAttribut->getMembersIncludingChildren(3)->count());
    }

    public function testMembersIncludingChildrenInfinite(): void
    {
        $source1 = $this->getMembersAttributClassMock();
        $source1->setMembers(new ArrayCollection());
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source5 = clone $source1;
        $source6 = clone $source1;
        $source1->setMembers(new ArrayCollection([$source2]));
        $source2->setMembers(new ArrayCollection([$source1, $source3]));
        $source3->setMembers(new ArrayCollection([$source4]));
        $source4->setMembers(new ArrayCollection([$source5]));
        $source5->setMembers(new ArrayCollection([$source6]));

        $this->membersAttribut->setMembers(new ArrayCollection([$source1]));
        $this->assertEquals(6, $this->membersAttribut->getMembersIncludingChildren()->count());
    }

    public function testMemberWithoutMembers(): void
    {
        $source1 = $this->createMock(SourceInterface::class);
        $this->membersAttribut->setMembers(new ArrayCollection([$source1]));
        $this->assertEquals(1, $this->membersAttribut->getMembersIncludingChildren()->count());
    }
}
