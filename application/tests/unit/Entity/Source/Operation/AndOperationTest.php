<?php

namespace App\Entity\Source\Operation;

use PHPUnit\Framework\TestCase;
use App\Exception\NotDefinedException;
use App\Logic\Result\Result;
use App\Logic\Operation\OperandInterface;
use App\Logic\Result\ResultInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
        $this->expectException(NotDefinedException::class);
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
