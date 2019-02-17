<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\MemberRelationAttributInterface;
use Infinito\Attribut\MemberRelationAttribut;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

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
        $this->assertNull($this->memberRelation->setMemberRelation($membership));
        $this->assertEquals($this->memberRelation->getMemberRelation(), $membership);
    }
}
