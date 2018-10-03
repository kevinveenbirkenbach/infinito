<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface TypeAttributInterface
{
    public function setType(string $type): void;

    public function getType(): string;
}
