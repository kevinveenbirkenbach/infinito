<?php

namespace Entity\Method;

use PHPUnit\Framework\TestCase;
use App\Entity\Method\CollectionDimensionHelperMethod;
use App\Helper\DimensionHelperInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\CollectionAttribut;
use App\Entity\Attribut\CollectionAttributInterface;

class CollectionDimensionHelperMethodTest extends TestCase
{
    /**
     * @var DimensionHelperInterface|CollectionAttributInterface
     */
    protected $method;

    private function getClassMock(): object
    {
        return new class() implements DimensionHelperInterface, CollectionAttributInterface {
            use CollectionDimensionHelperMethod,CollectionAttribut;

            public function __construct()
            {
                $this->collection = new ArrayCollection();
            }
        };
    }

    public function setUp(): void
    {
        $this->method = $this->getClassMock();
        $clone1 = $this->getClassMock();
        $clone2 = $this->getClassMock();
        $clone3 = $this->getClassMock();
        $clone1->getCollection()->add($clone2);
        $clone2->getCollection()->add($clone3);
        $this->method->getCollection()->add($clone1);
    }

    public function testTestSetUp(): void
    {
        $this->assertEquals(1, $this->method->getCollection()->count());
        $this->assertEquals(1, $this->method->getCollection()->get(0)->getCollection()->count());
    }

    public function testThatZeroAndOneDimensionAreUnique(): void
    {
        $this->assertFalse($this->method->getDimensions(0)->count() == $this->method->getDimensions(1)->count());
    }

    public function testZeroDimension(): void
    {
        $this->assertEquals(0, $this->method->getDimensions(0)->count());
    }

    public function testFirstDimension(): void
    {
        $this->assertEquals(1, $this->method->getDimensions(1)->count());
    }

    public function testSecondDimensionl(): void
    {
        $this->assertEquals(2, $this->method->getDimensions(2)->count());
    }

    public function testThirdtDimension(): void
    {
        $this->assertEquals(3, $this->method->getDimensions(3)->count());
    }

    public function testInfiniteDimension(): void
    {
        $this->assertEquals(3, $this->method->getDimensions()->count());
    }
}
