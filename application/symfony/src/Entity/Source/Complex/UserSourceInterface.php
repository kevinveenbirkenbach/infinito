<?php

namespace Infinito\Entity\Source\Complex;

use Infinito\Attribut\PersonIdentitySourceAttributInterface;
use Infinito\Attribut\UserAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserSourceInterface extends ComplexSourceInterface, UserAttributInterface, PersonIdentitySourceAttributInterface
{
    /**
     * Checks if the user has an identity source.
     */
    public function hasPersonIdentitySource(): bool;
}
