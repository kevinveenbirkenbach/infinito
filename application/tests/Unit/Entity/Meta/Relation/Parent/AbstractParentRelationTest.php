<?php

namespace tests\Unit\Entity\Meta;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use App\Entity\Meta\Relation\Parent\AbstractParentRelation;
use App\Entity\Meta\Relation\Parent\ParentRelationInterface;

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
