<?php

namespace tests\unit\Entity\Source;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\EntityInterface;
use Infinito\Entity\Meta\LawInterface;
use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Entity\Source\SourceInterface;
use PHPUnit\Framework\TestCase;

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
        $this->assertNull($this->source->getSlug());
    }
}
