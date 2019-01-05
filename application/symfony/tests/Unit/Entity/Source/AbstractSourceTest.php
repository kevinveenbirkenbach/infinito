<?php

namespace tests\unit\Entity\Source;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Entity\Meta\LawInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\EntityInterface;
use App\Entity\Meta\Relation\Parent\CreatorRelationInterface;
use App\Entity\Source\PureSource;

/**
 * @author kevinfrantz
 */
class AbstractSourceTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    public function setUp()
    {
        $this->source = new PureSource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(EntityInterface::class, $this->source);
        $this->assertInstanceOf(CreatorRelationInterface::class, $this->source->getCreatorRelation());
        $this->assertEquals($this->source, $this->source->getCreatorRelation()->getSource());
        $this->assertInstanceOf(Collection::class, $this->source->getMemberRelation()->getMemberships());
        $this->assertInstanceOf(LawInterface::class, $this->source->getLaw());
        $this->assertEquals($this->source, $this->source->getLaw()->getSource());
        $this->assertInstanceOf(Collection::class, $this->source->getMemberRelation()->getMembers());
    }

    public function testSlugInit(): void
    {
        $this->expectException(\TypeError::class);
        $this->source->getSlug();
    }
}
