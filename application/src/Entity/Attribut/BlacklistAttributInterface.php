<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
interface BlacklistAttributInterface
{
    public function setBlacklist(?bool $value): void;

    public function getBlacklist(): ?bool;
}
