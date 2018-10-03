<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface RecieverAttributInterface
{
    public function setReciever(string $type): void;

    public function getReciever(): string;
}
