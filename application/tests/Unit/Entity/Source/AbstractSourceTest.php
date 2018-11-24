<?php

namespace tests\unit\Entity\Source;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Entity\Meta\LawInterface;
use App\Entity\Meta\RelationInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\AbstractSource;
use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
class AbstractSourceTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    private function getSourceDummy(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    public function setUp()
    {
        $this->source = $this->getSourceDummy();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(EntityInterface::class, $this->source);
        $this->assertInstanceOf(RelationInterface::class, $this->source->getRelation());
        $this->assertInstanceOf(Collection::class, $this->source->getMemberships());
        $this->assertInstanceOf(LawInterface::class, $this->source->getLaw());
        $this->assertInstanceOf(Collection::class, $this->source->getMembers());
    }

    public function testAddAndRemoveMember(): void
    {
        $member = $this->getSourceDummy();
        $this->assertNull($this->source->addMember($member));
        $this->assertEquals($member, $this->source->getMembers()->get(0));
        $this->assertEquals($this->source, $member->getMemberships()->get(0));
        $this->assertNull($this->source->removeMember($member));
        $this->assertEquals(0, $this->source->getMembers()->count());
        $this->assertEquals(0, $member->getMemberships()->count());
    }

    public function testAddAndRemoveMembership(): void
    {
        $membership = $this->getSourceDummy();
        $this->assertNull($this->source->addMembership($membership));
        $this->assertEquals($membership, $this->source->getMemberships()->get(0));
        $this->assertEquals($this->source, $membership->getMembers()->get(0));
        $this->assertNull($this->source->removeMembership($membership));
        $this->assertEquals(0, $this->source->getMemberships()->count());
        $this->assertEquals(0, $membership->getMembers()->count());
    }

    public function testSlugInit(): void
    {
        $this->expectException(\TypeError::class);
        $this->source->getSlug();
    }
}
