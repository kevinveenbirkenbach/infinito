<?php

namespace Infinito\Entity;

use Infinito\Attribut\VersionAttributInterface;
use Infinito\Attribut\IdAttributInterface;

/**
 * @author kevinfrantz
 *
 * @todo Implement hash attribut which represents the state
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface
{
}
