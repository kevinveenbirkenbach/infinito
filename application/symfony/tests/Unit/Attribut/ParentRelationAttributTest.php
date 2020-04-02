<?php

namespace Infinito\Tests\Unit\Attribut;

use Infinito\Attribut\ParentRelationAttribut;
use Infinito\Attribut\ParentRelationAttributInterface;
use Infinito\Entity\Meta\Relation\Parent\ParentRelationInterface;
use PHPUnit\Framework\TestCase;

class ParentRelationAttributTest extends TestCase
{
    /***
     * @var ParentRelationAttributInterface
     */
    protected $parentRelationAttribut;

    public function setUp(): void
    {
        $this->parentRelationAttribut = new class() implements ParentRelationAttributInterface {
            use ParentRelationAttribut;
        };
    }

    public function testAccessors(): void
    {
        $relation = $this->createMock(ParentRelationInterface::class);
        $this->assertNull($this->parentRelationAttribut->setParentRelation($relation));
        $this->assertEquals($relation, $this->parentRelationAttribut->getParentRelation());
    }
}
