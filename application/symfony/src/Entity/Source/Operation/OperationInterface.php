<?php

namespace App\Entity\Source\Operation;

use App\Entity\Source\Operation\Attribut\OperandsAttributInterface;
use App\Logic\Operation\OperationInterface as OperationInterfaceOrigine;

interface OperationInterface extends OperandsAttributInterface, OperationInterfaceOrigine
{
}
