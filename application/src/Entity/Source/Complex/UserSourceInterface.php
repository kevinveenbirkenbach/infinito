<?php

namespace App\Entity\Source\Complex;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;
use App\Entity\Source\Primitive\DataSourceInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends DataSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
}
