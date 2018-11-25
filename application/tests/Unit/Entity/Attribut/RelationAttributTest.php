<?php

namespace App\Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\Relation\RelationInterface;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\RelationAttribut;

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
