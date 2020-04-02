<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\PriorityAttribut;
use Infinito\Attribut\PriorityAttributInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class PriorityAttributTest extends TestCase
{
    /**
     * @var PriorityAttributInterface
     */
    protected $priorityAttribut;

    public function setUp(): void
    {
        $this->priorityAttribut = new class() implements PriorityAttributInterface {
            use PriorityAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->priorityAttribut->getPriority();
    }

    public function testAccessors(): void
    {
        $priority = 123;
        $this->assertNull($this->priorityAttribut->setPriority($priority));
        $this->assertEquals($priority, $this->priorityAttribut->getPriority());
    }
}
