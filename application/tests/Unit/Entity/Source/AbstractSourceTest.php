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

    public function setUp()
    {
        $this->source = new class() extends AbstractSource {
        };
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(EntityInterface::class, $this->source);
        $this->assertInstanceOf(RelationInterface::class, $this->source->getRelation());
        $this->assertInstanceOf(Collection::class, $this->source->getMemberships());
        $this->assertInstanceOf(LawInterface::class, $this->source->getLaw());
        $this->assertInstanceOf(Collection::class, $this->source->getMembers());
    }

    public function testSlugInit(): void
    {
        $this->expectException(\TypeError::class);
        $this->source->getSlug();
    }
}
