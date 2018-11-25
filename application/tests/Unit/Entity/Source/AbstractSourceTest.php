<?php

namespace tests\unit\Entity\Source;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Entity\Meta\LawInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\AbstractSource;
use App\Entity\EntityInterface;
use App\Entity\Meta\Relation\Parent\CreatorRelationInterface;

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
        $this->assertInstanceOf(CreatorRelationInterface::class, $this->source->getCreatorRelation());
        $this->assertEquals($this->source, $this->source->getCreatorRelation()->getSource());
        $this->assertInstanceOf(Collection::class, $this->source->getMemberships());
        $this->assertInstanceOf(LawInterface::class, $this->source->getLaw());
        $this->assertEquals($this->source, $this->source->getLaw()->getSource());
        $this->assertInstanceOf(Collection::class, $this->source->getMembers());
    }

    public function testSlugInit(): void
    {
        $this->expectException(\TypeError::class);
        $this->source->getSlug();
    }
}
