<?php

namespace Infinito\Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Meta\Relation\RelationInterface;
use Infinito\Attribut\RelationAttributInterface;
use Infinito\Attribut\RelationAttribut;

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
