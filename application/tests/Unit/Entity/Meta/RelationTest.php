<?php

namespace tests\Unit\Entity\Meta;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\RelationInterface;
use App\Entity\Meta\Relation;
use Doctrine\Common\Collections\Collection;

class RelationTest extends TestCase
{
    /**
     * @var RelationInterface
     */
    protected $relation;

    public function setUp(): void
    {
        $this->relation = new Relation();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->relation->getChilds());
        $this->assertInstanceOf(Collection::class, $this->relation->getParents());
        $this->expectException(\TypeError::class);
        $this->relation->getSource();
    }
}
