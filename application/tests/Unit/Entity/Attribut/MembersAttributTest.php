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
        $this->assertTrue($this->getContinueIncludeMemberLoopResult(2));
        $this->assertTrue($this->getContinueIncludeMemberLoopResult(1));
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
        $this->assertTrue($this->membersAttribut->getMembers()->contains($source1));
    }
    
    public function testFirstLevelMembersInclusiveChildren():void{
        $source1 = new GroupSource();
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source3->setMembers(new ArrayCollection([$source4]));
        $members = new ArrayCollection([$source1,$source2,$source3]);
        $this->assertNull($this->membersAttribut->setMembers($members));
        $this->assertEquals(3,$this->membersAttribut->getMembersInclusiveChildren(1)->count());
    }
    
    public function test3DimensionsMembersInclusiveChildren():void{
        $source1= new GroupSource();
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source1->setMembers(new ArrayCollection([$source2]));
        $source2->setMembers(new ArrayCollection([$source3]));
        $source3->setMembers(new ArrayCollection([$source4]));
        $this->membersAttribut->setMembers(new ArrayCollection([$source1]));
        $this->assertEquals(1,$this->membersAttribut->getMembers()->count());
        $this->assertEquals(1,$source1->getMembers()->count());
        $this->assertEquals(1,$source2->getMembers()->count());
        $this->assertEquals(1,$source3->getMembers()->count());
        $this->assertEquals(0,$source4->getMembers()->count());
        $this->assertEquals(3,$this->membersAttribut->getMembersInclusiveChildren(3)->count());
    }

    public function testMembersIncludingChildren(): void
    {
        $source1 = new GroupSource();
        $source2 = clone $source1;
        $source3 = clone $source1;
        $source4 = clone $source1;
        $source5 = clone $source1;
        $source6 = clone $source1;
        $source7 = clone $source1;
        $source8 = clone $source1;
        $source9 = new class() extends AbstractSource {
        };
        //Level 3
        
        $source1->setMembers(new ArrayCollection([$source2]));
        $source2->setMembers(new ArrayCollection([$source3]));
        $source3->setMembers(new ArrayCollection([$source4]));
        $source4->setMembers(new ArrayCollection([$source5]));
        $source5->setMembers(new ArrayCollection([$source6]));

        $level3Elements = [$source1, $source2, $source3];

        //Recursion
        //$source7->setMembers(new ArrayCollection([$source8]));
        //$source8->setMembers(new ArrayCollection([$source7]));

        $allMembers = [$source1, $source2, $source3, $source4, $source5, $source6, $source7, $source8, $source9];
        
        //$this->assertArraySubset($source1->getMembersInclusiveChildren(5)->toArray(), $level3Elements);
        //$this->assertArraySubset($source1->getMembersInclusiveChildren(3)->toArray(), $level3Elements);
        //$this->assertArraySubset($source1->getMembersInclusiveChildren()->toArray(), $allMembers);
        //$this->assertArraySubset($source1->getMembers()->toArray(), $source1->getMembersInclusiveChildren(1)->toArray());
        //$this->assertArraySubset($source1->getMembersInclusiveChildren(1)->toArray(), $source1->getMembers()->toArray());
    }
}
