<?php

namespace App\Entity\Source\Complex;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends ComplexSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
}
