<?php

namespace tests\unit\Entity\Source\Operand;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\Operation\AbstractOperation;
use Infinito\Entity\Source\Operation\OperationInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Logic\Operation\OperandInterface;
use Infinito\Logic\Result\ResultInterface;
use Infinito\Logic\Result\Result;
use Infinito\Exception\Deprecated\NotProcessedException;

/**
 * @author kevinfrantz
 */
class AbstractOperationTest extends TestCase
{
    /**
     * @var OperationInterface
     */
    protected $operation;

    public function setUp(): void
    {
        $this->operation = new class() extends AbstractOperation {
            public function process(): void
            {
                $this->result = new Result();
            }
        };
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->operation->getOperands());
    }

    public function testOperands(): void
    {
        $operand = new class() implements OperandInterface {
            public function getResult(): ResultInterface
            {
                return new Result();
            }
        };
        $operands = new ArrayCollection();
        $operands->add($operand);
        $this->assertNull($this->operation->setOperands($operands));
        $this->assertEquals($operand, $this->operation->getOperands()
            ->get(0));
    }

    public function testNotProcessedException(): void
    {
        $this->expectException(NotProcessedException::class);
        $this->operation->getResult();
    }

    public function testResult(): void
    {
        $this->setUp();
        $this->operation->process();
        $this->assertInstanceOf(ResultInterface::class, $this->operation->getResult());
    }

    public function testProcess(): void
    {
        $this->assertEquals(null, $this->operation->process());
    }
}
