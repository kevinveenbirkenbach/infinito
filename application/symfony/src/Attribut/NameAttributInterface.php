<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
interface NameAttributInterface
{
    public function setName(string $name): void;

    public function getName(): string;
}
