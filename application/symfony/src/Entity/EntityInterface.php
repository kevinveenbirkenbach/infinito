<?php

namespace Infinito\Entity;

use Infinito\Attribut\IdAttributInterface;
use Infinito\Attribut\VersionAttributInterface;

/**
 * @author kevinfrantz
 *
 * @todo Implement hash attribut which represents the state
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface
{
}
