<?php

namespace App\Tests\Unit\Helper;

use App\Tests\AbstractTestCase;
use App\Helper\DimensionHelper;
use App\Helper\DimensionHelperInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class HelperTest extends AbstractTestCase
{
    /**
     * @var DimensionHelperInterface
     */
    protected $dimensionMock;

    public function setUp(): void
    {
        $this->dimensionMock = new class() implements DimensionHelperInterface {
            /**
             * @var ArrayCollection
             */
            public $dimensionElements;

            /**
             * @var DimensionHelper
             */
            public $dimensionHelper;

            public function __construct()
            {
                $this->dimensionElements = new ArrayCollection();
                $this->dimensionHelper = new DimensionHelper('getDimensions', DimensionHelperInterface::class, $this, 'dimensionElements');
            }

            public function getDimensionElements(): Collection
            {
                return $this->dimensionElements;
            }

            public function getDimensions(?int $dimension = null, Collection $elements = null): Collection
            {
                return $this->dimensionHelper->getDimensions($dimension, $elements);
            }
        };
    }

    private function getContinueLoopResult($dimension): bool
    {
        $this->setProperty($this->dimensionMock->dimensionHelper, 'dimension', $dimension);

        return $this->invokeMethod($this->dimensionMock->dimensionHelper, 'continueLoop');
    }

    public function testContinueLoop(): void
    {
        $this->assertTrue($this->getContinueLoopResult(null));
        $this->assertTrue($this->getContinueLoopResult(2));
        $this->assertTrue($this->getContinueLoopResult(1));
        $this->assertFalse($this->getContinueLoopResult(0));
        $this->assertFalse($this->getContinueLoopResult(-1));
    }
}
