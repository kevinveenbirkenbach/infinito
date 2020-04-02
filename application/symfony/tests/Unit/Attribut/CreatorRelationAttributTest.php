<?php

namespace Infinito\Tests\Unit\Attribut;

use Infinito\Attribut\CreatorRelationAttribut;
use Infinito\Attribut\CreatorRelationAttributInterface;
use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;
use PHPUnit\Framework\TestCase;

class CreatorRelationAttributTest extends TestCase
{
    /***
     * @var CreatorRelationAttributInterface
     */
    protected $creatorRelationAttribut;

    public function setUp(): void
    {
        $this->creatorRelationAttribut = new class() implements CreatorRelationAttributInterface {
            use CreatorRelationAttribut;
        };
    }

    public function testAccessors(): void
    {
        $relation = $this->createMock(CreatorRelationInterface::class);
        $this->assertNull($this->creatorRelationAttribut->setCreatorRelation($relation));
        $this->assertEquals($relation, $this->creatorRelationAttribut->getCreatorRelation());
    }
}
