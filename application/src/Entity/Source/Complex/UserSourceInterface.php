<?php

namespace App\Entity\Source\Complex;

use App\Entity\Attribut\UserAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends ComplexSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
    /**
     * Checks if the user has an identity source.
     *
     * @return bool
     */
    public function hasPersonIdentitySource(): bool;
}
