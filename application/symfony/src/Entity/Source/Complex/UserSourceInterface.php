<?php

namespace Infinito\Entity\Source\Complex;

use Infinito\Attribut\UserAttributInterface;
use Infinito\Attribut\PersonIdentitySourceAttributInterface;

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
