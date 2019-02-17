<?php

namespace Tests\Unit\Entity\Source;

use Infinito\Entity\Source\PureSourceInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Entity\Source\AbstractSource;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class PureSourceTest extends TestCase
{
    /**
     * @var PureSourceInterface
     */
    private $pureSource;

    /**
     * @var SourceInterface
     */
    private $abstractSource;

    public function setUp(): void
    {
        $this->pureSource = new PureSource();
        $this->abstractSource = new class() extends AbstractSource {
        };
    }

    public function testMethodSet(): void
    {
        $pureSourceMethods = get_class_methods($this->pureSource);
        $abstractSourceMethods = get_class_methods($this->abstractSource);
        $this->assertArraySubset($pureSourceMethods, $abstractSourceMethods);
    }
}
