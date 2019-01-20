<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
interface GrantAttributInterface
{
    public function setGrant(bool $grant): void;

    public function getGrant(): bool;
}
