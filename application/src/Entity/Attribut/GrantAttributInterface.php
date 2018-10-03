<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
interface GrantAttributInterface
{
    public function setGrant(bool $grant): void;

    public function getGrant(): bool;
}
