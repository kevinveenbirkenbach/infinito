<?php

namespace App\Entity\Source\Data;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\NameSourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends DataSourceInterface, UserAttributInterface, NameSourceAttributInterface
{
}
