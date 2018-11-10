<?php

namespace App\Entity\Source\Data;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends DataSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
}
