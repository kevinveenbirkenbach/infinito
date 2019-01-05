<?php

namespace tests\unit\Entity\Source\Operand;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Operation\AbstractOperation;
use App\Entity\Source\Operation\OperationInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Logic\Operation\OperandInterface;
use App\Logic\Result\ResultInterface;
use App\Logic\Result\Result;
use App\Exception\NotProcessedException;

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
