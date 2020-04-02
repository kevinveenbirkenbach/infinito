<?php

namespace Tests\Unit\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Attribut\CollectionAttribut;
use Infinito\Attribut\CollectionAttributInterface;
use PHPUnit\Framework\TestCase;

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
