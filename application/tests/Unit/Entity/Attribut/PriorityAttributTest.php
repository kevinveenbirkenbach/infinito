<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\PriorityAttributInterface;
use App\Entity\Attribut\PriorityAttribut;

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
