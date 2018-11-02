<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\MembershipsAttributInterface;
use App\Entity\Attribut\MembershipsAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\Collection\TreeCollectionSourceInterface;

class MembershipsAttributTest extends TestCase
{
    /**
     * @var MembershipsAttributInterface
     */
    protected $memberships;

    public function setUp(): void
    {
        $this->memberships = new class() implements MembershipsAttributInterface {
            use MembershipsAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->memberships->getMemberships();
    }

    public function testAccessors(): void
    {
        $membership = $this->createMock(TreeCollectionSourceInterface::class);
        $this->assertNull($this->memberships->setMemberships(new ArrayCollection([$membership])));
        $this->assertEquals($this->memberships->getMemberships()->get(0), $membership);
    }
}
