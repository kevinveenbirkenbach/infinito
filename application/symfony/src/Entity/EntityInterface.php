<?php

namespace App\Entity;

use App\Entity\Attribut\VersionAttributInterface;
use App\Entity\Attribut\IdAttributInterface;
use App\Entity\Attribut\SlugAttributInterface;

/**
 * @author kevinfrantz
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface, SlugAttributInterface
{
}
