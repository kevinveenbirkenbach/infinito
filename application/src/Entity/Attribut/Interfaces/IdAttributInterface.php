<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface IdAttributInterface
{
    public function setId(int $id): void;

    public function getId(): int;
}
