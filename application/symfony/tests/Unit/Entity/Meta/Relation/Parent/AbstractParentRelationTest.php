<?php

namespace tests\Unit\Entity\Meta;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Parent\AbstractParentRelation;
use Infinito\Entity\Meta\Relation\Parent\ParentRelationInterface;
use PHPUnit\Framework\TestCase;

class AbstractParentRelationTest extends TestCase
{
    /**
     * @var ParentRelationInterface
     */
    protected $relation;

    public function setUp(): void
    {
        $this->relation = new class() extends AbstractParentRelation {
        };
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->relation->getChilds());
        $this->assertInstanceOf(Collection::class, $this->relation->getParents());
        $this->assertEquals(0, $this->relation->getVersion());
        $this->expectException(\TypeError::class);
        $this->relation->getSource();
    }
}
