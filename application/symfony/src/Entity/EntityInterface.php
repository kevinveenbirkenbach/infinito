<?php

namespace App\Entity;

use App\Attribut\VersionAttributInterface;
use App\Attribut\IdAttributInterface;

/**
 * @author kevinfrantz
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface
{
}
