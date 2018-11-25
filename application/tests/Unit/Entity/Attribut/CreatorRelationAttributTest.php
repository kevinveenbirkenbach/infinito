<?php

namespace App\Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\CreatorRelationAttributInterface;
use App\Entity\Attribut\CreatorRelationAttribut;
use App\Entity\Meta\Relation\CreatorRelationInterface;

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
