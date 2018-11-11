<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;
use App\Entity\Source\Data\DataSourceInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends DataSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
}
