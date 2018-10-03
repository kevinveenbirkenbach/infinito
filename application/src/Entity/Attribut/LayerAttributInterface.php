<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface LayerAttributInterface
{
    public function setLayer(string $layer): void;

    public function getLayer(): string;
}
