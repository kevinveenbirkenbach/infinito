<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface NameAttributInterface
{
    public function setName(string $name): void;

    public function getName(): string;
}
