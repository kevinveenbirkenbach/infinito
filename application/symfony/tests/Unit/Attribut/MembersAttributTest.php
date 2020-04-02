<?php

namespace Tests\Unit\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Attribut\MembersAttribut;
use Infinito\Attribut\MembersAttributInterface;
use Infinito\Entity\Source\SourceInterface;
use PHPUnit\Framework\TestCase;

class MembersAttributTest extends TestCase
{
    /**
     * @var MembersAttributInterface
     */
    protected $members;

    public function setUp(): void
    {
        $this->members = new class() implements MembersAttributInterface {
            use MembersAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->members->getMembers();
    }

    public function testAccessors(): void
    {
        $membership = $this->createMock(SourceInterface::class);
        $this->assertNull($this->members->setMembers(new ArrayCollection([$membership])));
        $this->assertEquals($this->members->getMembers()->get(0), $membership);
    }
}
