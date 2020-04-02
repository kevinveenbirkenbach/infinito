<?php

namespace Attribut;

use Infinito\Attribut\ConditionAttribut;
use Infinito\Attribut\ConditionAttributInterface;
use Infinito\Logic\Operation\OperationInterface;
use PHPUnit\Framework\TestCase;

class ConditionAttributTest extends TestCase
{
    /**
     * @var ConditionAttributInterface
     */
    protected $condition;

    public function setUp(): void
    {
        $this->condition = new class() implements ConditionAttributInterface {
            use ConditionAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->condition->getCondition();
    }

    public function testAccessors(): void
    {
        $this->assertEquals(false, $this->condition->hasCondition());
        $condition = $this->createMock(OperationInterface::class);
        $this->assertNull($this->condition->setCondition($condition));
        $this->assertEquals(true, $this->condition->hasCondition());
        $this->assertEquals($condition, $this->condition->getCondition());
    }
}
