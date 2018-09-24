<?php

namespace App\Entity\Interfaces;

use App\Entity\Attribut\Interfaces\NodeAttributInterface;
use App\Entity\Attribut\Interfaces\IdAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, NodeAttributInterface
{
}
