<?php

namespace App\Entity;

use App\Entity\Attribut\Interfaces\NodeAttributInterface;
use App\Entity\Attribut\Interfaces\IdAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, NodeAttributInterface
{
}
