<?php

namespace App\Entity\Interfaces;

use App\Entity\Attribut\Interfaces\UserAttributInterface;
use App\Entity\Attribut\Interfaces\NameSourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends SourceInterface, UserAttributInterface, NameSourceAttributInterface
{
}
