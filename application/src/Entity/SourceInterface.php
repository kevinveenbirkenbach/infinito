<?php

namespace App\Entity;

use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\IdAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, NodeAttributInterface
{
}
