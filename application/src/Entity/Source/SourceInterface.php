<?php
namespace App\Entity\Source;

use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Entity\Source\Attribut\GroupSourcesAttributInterface;

/**
 *
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, GroupSourcesAttributInterface
{
}
