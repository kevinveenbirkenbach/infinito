<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
interface LayerAttributInterface
{
    public function setLayer(string $layer): void;

    public function getLayer(): string;
}
