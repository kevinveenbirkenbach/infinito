<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\CollectionAttributInterface;
use Infinito\Attribut\CollectionAttribut;
use Doctrine\Common\Collections\ArrayCollection;

class CollectionAttributTest extends TestCase
{
    /**
     * @var CollectionAttributInterface
     */
    protected $collection;

    public function setUp(): void
    {
        $this->collection = new class() implements CollectionAttributInterface {
            use CollectionAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->collection->getCollection();
    }

    public function testAccessors(): void
    {
        $collection = new ArrayCollection();
        $this->assertNull($this->collection->setCollection($collection));
        $this->assertEquals($collection, $this->collection->getCollection());
    }

    public function testAdd(): void
    {
        $mock = new class() {
        };
        $this->collection->setCollection(new ArrayCollection());
        $this->assertTrue($this->collection->getCollection()->add($mock));
        $this->assertEquals($mock, $this->collection->getCollection()->get(0));
    }
}
