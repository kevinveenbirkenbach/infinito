<?php
namespace App\Entity\Source\Operation;

use App\Logic\Result\ResultInterface;
use App\Logic\Operation\OperationInterface;
use App\Logic\Operation\OperandInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\AbstractSource;

/**
 *
 * @author kevinfrantz
 * @ORM\Entity
 * @ORM\Table(name="source_operation")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"and" = "AndOperation"})
 */
abstract class AbstractOperation extends AbstractSource implements OperationInterface
{

    /**
     * The result MUST NOT be saved via Doctrine!
     *
     * @var ResultInterface
     */
    protected $result;

    /**
     *
     * @var ArrayCollection|OperandInterface[]
     */
    protected $operands;

    public function getResult(): ResultInterface
    {
        return $this->result;
    }

    public function setOperators(ArrayCollection $operands): void
    {
        $this->operands = $operands;
    }
}
