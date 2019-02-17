<?php

namespace Infinito\Entity\Source\Operation;

use Infinito\Entity\Source\Operation\Attribut\OperandsAttributInterface;
use Infinito\Logic\Operation\OperationInterface as OperationInterfaceOrigine;

interface OperationInterface extends OperandsAttributInterface, OperationInterfaceOrigine
{
}
