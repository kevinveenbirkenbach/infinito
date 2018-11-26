<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\MemberRelationAttributInterface;
use App\Entity\Attribut\MemberRelationAttribut;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;

class MemberRelationAttributTest extends TestCase
{
    /**
     * @var MemberRelationAttributInterface
     */
    protected $memberRelation;

    public function setUp(): void
    {
        $this->memberRelation = new class() implements MemberRelationAttributInterface {
            use MemberRelationAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->memberRelation->getMemberRelation();
    }

    public function testAccessors(): void
    {
        $membership = $this->createMock(MemberRelationInterface::class);
        $this->assertNull($this->memberRelation->setMemberRelation(new ArrayCollection([$membership])));
        $this->assertEquals($this->memberRelation->getMemberRelation()->get(0), $membership);
    }
}
