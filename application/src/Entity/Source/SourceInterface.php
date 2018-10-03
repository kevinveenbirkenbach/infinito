<?php
namespace App\Entity\Source;

use App\Entity\Attribut\NodeAttributInterface;
use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;

/**
 *
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, NodeAttributInterface, EntityInterface
{
}
