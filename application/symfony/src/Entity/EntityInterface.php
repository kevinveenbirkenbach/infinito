<?php

namespace App\Entity;

use App\Attribut\VersionAttributInterface;
use App\Attribut\IdAttributInterface;
use App\Attribut\SlugAttributInterface;

/**
 * @author kevinfrantz
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface, SlugAttributInterface
{
}
