<?php

namespace App\Entity;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\NameSourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends SourceInterface, UserAttributInterface, NameSourceAttributInterface
{
}
