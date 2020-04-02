<?php

namespace tests\unit\Entity\Source\Operation;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Entity\Source\Operation\AndOperation;
use Infinito\Entity\Source\Operation\OperationInterface;
use Infinito\Exception\Attribut\UndefinedAttributException;
use Infinito\Logic\Operation\OperandInterface;
use Infinito\Logic\Result\Result;
use Infinito\Logic\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class AndOperationTest extends TestCase
{
    /**
     * @var OperationInterface
     */
    protected $operation;

    public function setUp(): void
    {
        $this->operation = new AndOperation();
    }

    public function testConstructor(): void
    {
        $this->expectException(UndefinedAttributException::class);
        $this->operation->process();
    }

    public function testProcess(): void
    {
        //Test True
        $operand1 = new class() implements OperandInterface {
            public function getResult(): ResultInterface
            {
                $result = new Result();
                $result->setAll(true);

                return $result;
            }
        };

        $operand2 = new class() implements OperandInterface {
            public function getResult(): ResultInterface
            {
                $result = new Result();
                $result->setAll(true);

                return $result;
            }
        };
        $operands = new ArrayCollection([$operand1, $operand2]);
        $this->operation->setOperands($operands);
        $this->operation->process();
        $this->assertEquals(true, $this->operation->getResult()->getBool());

        //Test False
        $operand3 = new class() implements OperandInterface {
            public function getResult(): ResultInterface
            {
                $result = new Result();
                $result->setAll(false);

                return $result;
            }
        };
        $this->operation->getOperands()->add($operand3);
        $this->operation->process();
        $this->assertEquals(false, $this->operation->getResult()->getBool());
    }
}
