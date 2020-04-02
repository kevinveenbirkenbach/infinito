<?php

namespace Infinito\Tests\Unit\Attribut;

use Infinito\Attribut\RelationAttribut;
use Infinito\Attribut\RelationAttributInterface;
use Infinito\Entity\Meta\Relation\RelationInterface;
use PHPUnit\Framework\TestCase;

class RelationAttributTest extends TestCase
{
    /***
     * @var RelationAttributInterface
     */
    protected $relationAttribut;

    public function setUp(): void
    {
        $this->relationAttribut = new class() implements RelationAttributInterface {
            use RelationAttribut;
        };
    }

    public function testAccessors(): void
    {
        $relation = $this->createMock(RelationInterface::class);
        $this->assertNull($this->relationAttribut->setRelation($relation));
        $this->assertEquals($relation, $this->relationAttribut->getRelation());
    }
}
