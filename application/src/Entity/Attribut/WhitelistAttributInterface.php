<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface WhitelistAttributInterface
{
    public function setWhitelist(?bool $value): void;

    public function getWhitelist(): ?bool;
}
