<?php

namespace App\Tests\Unit\Entity\Attribut;

use App\Entity\Attribut\MembersAttribut;
use App\Entity\Attribut\MembersAttributInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\AbstractSource;
use App\Entity\Source\GroupSource;
use App\Tests\AbstractTestCase;
use phpDocumentor\Reflection\Types\Boolean;

class MembersAttributTest extends AbstractTestCase
{
    /**
     * @var MembersAttributInterface
     */
    protected $membersAttribut;

    public function setUp(): void
    {
        $this->membersAttribut = new class() implements MembersAttributInterface {
            use MembersAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->membersAttribut->getMembers();
        $this->membersAttribut->getMembersInclusiveChildren();
    }
    
    private function getContinueIncludeMemberLoopResult($dimension):bool{
        return $this->invokeMethod($this->membersAttribut, 'continueIncludeMembersLoop', [$dimension]);
    }
    
    public function testContinueIncludeMemberLoop(){
        $this->assertTrue($this->getContinueIncludeMemberLoopResult(null));
        $this->assertTrue($this->getContinueIncludeMemberLoopResult(1));
        $this->assertTrue($this->getContinueIncludeMemberLoopResult(2));
        $this->assertFalse($this->getContinueIncludeMemberLoopResult(0));
        $this->assertFalse($this->getContinueIncludeMemberLoopResult(-1));
    }

    public function testMembersAccessors()
    {
        $source1 = new class() extends AbstractSource {
        };
        $source2 = clone $source1;
        $source3 = clone $source1;
        $members = new ArrayCollection([
            $source1,
            $source2,
            $source3,
        ]);
        $this->assertNull($this->membersAttribut->setMembers($members));
        $this->assertEquals($members, $this->membersAttribut->getMembers());
    }

    public function testMembersIncludingChildren(): void
    {
        $source1 = new GroupSource();

        //Level 3
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source5 = clone $source1;
        $source6 = clone $source1;
        $source1->setMembers(new ArrayCollection([$source2]));
        $source2->setMembers(new ArrayCollection([$source3]));
        $source3->setMembers(new ArrayCollection([$source4]));
        $source4->setMembers(new ArrayCollection([$source5]));
        $source5->setMembers(new ArrayCollection([$source6]));

        $level3Elements = [$source1, $source2, $source3];

        //Recursion
        $source7 = clone $source1;
        $source8 = clone $source1;
        $source7->setMembers(new ArrayCollection([$source8]));
        $source8->setMembers(new ArrayCollection([$source7]));

        //Source without members:
        $source9 = new class() extends AbstractSource {
        };
        $allMembers = [$source1, $source2, $source3, $source4, $source5, $source6, $source7, $source8, $source9];
        //$this->assertArraySubset($source1->getMembersInclusiveChildren(3)->toArray(), $level3Elements);
        $this->assertArraySubset($source1->getMembersInclusiveChildren()->toArray(), $allMembers);
        //$this->assertArraySubset($source1->getMembers()->toArray(), $source1->getMembersInclusiveChildren(1)->toArray());
        //$this->assertArraySubset($source1->getMembersInclusiveChildren(1)->toArray(), $source1->getMembers()->toArray());
    }
}
